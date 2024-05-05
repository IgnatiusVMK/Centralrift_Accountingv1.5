# Centralrift_Accountingv1.5
<img src='/public/images/marley.png' alt='Logo' width='100' height='100'>

## Maker-checker validation Docs 

Implementing a maker-checker pattern in Laravel involves creating a workflow where certain actions are first initiated by a "maker" and then reviewed and approved by a "checker." Below is a basic outline of how I intend to implement this pattern in my Laravel Application:

Database Setup:
My expenses table, (and all other tables requiring maker-checker) have a column to store the approval status, such as status (pending, approved, rejected), and a column for the checker_id.

Define Permissions:
    Create permissions related to the maker-checker pattern, such as approve-cycles, approve-expense, approve-credit, approve-sales etc.

Assign Permissions to Roles:
    Assign the create-expense/cycles/credit permission to roles that should be able to create new expenses (e.g. Management).
    Assign the approve-'' permissions to roles that should be able to approve expenses (e.g. Admin & Executive).

Check Permissions in Gates/Policies:
    Using Laravel's gates and policies to check if a user has the necessary permissions to perform specific actions (e.g., creating, approving, deleting etc.).

Middleware:
    Using middleware to perform general role-based access checks before reaching the gates/policies. This will ensure that only users with the correct roles are allowed to access certain routes or perform certain actions.

Controller Logic:
    In my controller for the various models, when a user submits a new entry, set the status to pending and save the record.
    Redirect the user to a confirmation page or show a message indicating that the expense has been submitted for approval.

Checker Approval:
    Create a page or functionality for checkers to review and approve/reject pending expenses. Also intergrate this on the dashboard, and abstract for view only by Admin role and Executive.
    When a checker approves or rejects an expense, update the corresponding record in the respective tables with the checker_id, status, and the approval/rejection timestamp.

Workflow Implementation:
    In my application logic, check the status of records before allowing certain operations to proceed.
    For example, if a user tries to edit or delete an record, check if it is in pending status. If so, prevent the action until the expense is approved or rejected.

Cycle_Id Consideration:
    Since expenses are appended to Cycle_Id's, ensure that the approval workflow considers the Cycle_Id when fetching and displaying expenses for approval.


NOTE:
Adding a status column to all necessary tables and only displaying entries if they are approved is a logical approach for implementing the maker-checker pattern. This ensures that only approved entries are considered in calculations such as profit and loss, which helps maintain data integrity and accuracy in my application.

To calculate profit and loss based on the approval status, there will be modification of queries to consider only approved entries. For example, when calculating profit, sum will be done in considertaion of the profits from approved entries and subtract the expenses from approved entries to get the net profit. This approach ensures that only finalized and approved data is used in financial calculations.