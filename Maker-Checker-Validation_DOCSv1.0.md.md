# Maker-checker validation Docs
* Implementing a maker-checker pattern in Laravel involves creating a workflow where certain actions are first initiated by a "maker" and then reviewed and approved by a "checker." Below is a basic outline of how I intend to implement this pattern in my Laravel Application:

    1. ***Database Setup:*** My expenses table, (and all other tables requiring maker-checker) have a column to store the approval status, such as status (pending, approved, rejected), and a column for the checker_id.

        ```php
        $table->string('Status')->default('pending');
        $table->unsignedBigInteger('checker_id')->nullable();
        $table->unsignedBigInteger('maker_id')->nullable();

        $table->foreign('checker_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('maker_id')->references('id')->on('users')->onDelete('cascade');
        ```

    2. ***Define Permissions:*** Create permissions related to the maker-checker pattern, such as approve-cycles, approve-expense, approve-credit, approve-sales etc.

    3. ***Assign Permissions to Roles:*** Assign the create-expense/cycles/credit permission to roles that should be able to create new expenses (e.g. Management). Assign the approve-'' permissions to roles that should be able to approve expenses (e.g. Admin & Executive).

    4. ***Check Permissions in Gates/Policies:*** Using Laravel's gates and policies to check if a user has the necessary permissions to perform specific actions (e.g., creating, approving, deleting etc.).
        ```php
        class MakerPolicy
        {
            /**
             * Create a new policy instance.
            */

            public function __construct()
            {
                //
            }
            public function access(User $user)
            {
                return $user->hasRole('Admin') || $user->hasPermission('access_maker');
            }
            public function create(User $user)
            {
                return $user->hasRole('Admin') ||  $user->hasPermission('create_maker');
            }
            public function view(User $user)
            {
                return $user->hasRole('Admin') ||  $user->hasPermission('view_maker');
            }
        }
        ```
        ```php
        class CheckerPolicy
        {
            /**
            * Create a new policy instance.
            */
            public function __construct()
            {
                //
            }

            public function access(User $user)
            {
                return $user->hasRole('Admin') || $user->hasPermission('access_approval');
            }
            public function create(User $user)
            {
                return $user->hasRole('Admin') ||  $user->hasPermission('create_approval');
            }
            public function view(User $user)
            {
                return $user->hasRole('Admin') ||  $user->hasPermission('view_approval');
            }
        }
        ```
    <br/>

    5. ***Middleware:*** Using middleware to perform general role-based access checks before reaching the gates/policies. This will ensure that only users with the correct roles are allowed to access certain routes or perform certain actions.

        ```php
        $this->authorize('access-approval');
        ```

        ```php
        $this->authorize('view-approval');
        ```
        ```php
        $this->authorize('create-approval');
        ```
    <br/>

    6. ***Controller Logic:*** In my controller for the various models, when a user submits a new entry, set the status to pending and save the record. Redirect the user to a confirmation page or show a message indicating that the expense has been submitted for approval.

        ```php
        return redirect()->route('cycle.sales.create', ['Cycle_Id' => $request->Cycle_Id])->with('success', 'Sale Recorded.');
        ```

    7. ***Checker Approval:*** Create a page or functionality for checkers to review and approve/reject pending expenses. Also intergrate this on the dashboard, and abstract for view only by Admin role and Executive. When a checker approves or rejects an expense, update the corresponding record in the respective tables with the checker_id, status, and the approval/rejection timestamp.

        ```php
          @can('access-approval')
            <li class="nav-item nav-category">Checker Validation</li>
            <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#checker" aria-expanded="false" aria-controls="checker">
              <i class="menu-icon mdi {{-- mdi-folder-plus --}} mdi-playlist-plus"></i>
              <span class="menu-title">Approvals</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="checker">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{('/checker')}}">Pending Approvals</a></li>
              </ul>
            </div>
          </li>
          @endcan
        ```
        ```php
        @extends('layouts.app')

        @section('content')
            @can('view-approval')
            {{-- Page Content--}}
            @endcan
        @endsection
        ```

    8. ***Workflow Implementation:*** In my application logic, check the status of records before allowing certain operations to proceed. For example, if a user tries to edit or delete an record, check if it is in pending status. If so, prevent the action until the expense is approved or rejected.

Cycle_Id Consideration: Since expenses are appended to Cycle_Id's, ensure that the approval workflow considers the Cycle_Id when fetching and displaying expenses for approval.

<u>***NOTE:***</u> <br/> Adding a status column to all necessary tables and only displaying entries if they are approved is a logical approach for implementing the maker-checker pattern. This ensures that only approved entries are considered in calculations such as profit and loss, which helps maintain data integrity and accuracy in my application.

* To calculate profit and loss based on the approval status, there will be modification of queries to consider only approved entries.
    * ***For example;***  when calculating profit, sum will be done in considertaion of the profits from approved entries and subtract the expenses from approved entries to get the net profit.

* This approach ensures that only finalized and approved data is used in financial calculations.