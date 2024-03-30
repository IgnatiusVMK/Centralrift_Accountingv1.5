<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Centralrift-Kenya-LTD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<body>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex items-center"> 
            <img src="{{ asset('images/marley.png') }}" alt="HOM_Logo"> 
            <div class="border-l-2 h-12 border-gray-400"></div> 
            <div class="text-xl font-bold text-gray-800">Centralrift-Kenya-LTD</div> 
        </div>
    </div>
    <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="row">
                        <div class="col text-end">
                            <h1>Centralrift-Kenya-LTD</h1>
                            <!-- <h1>Centralrift-Kenya-LTD</h1>
                            <h1>Centralrift-Kenya-LTD</h1>
                            <h1>Centralrift-Kenya-LTD</h1>
                            <h1>Centralrift-Kenya-LTD</h1> -->
                        </div>
                    </div>
                <div class="card-body">
                    <div class="card w-50">
                        <h1 class="card-header text-success">Summary of Accounts</h1>
                        <div class="card-body">
                            <p>Total Credited Amount:</p>
                            <p>Total Debited Amount:</p>
                            <p>Available Balance:</p>
                        </div>
                    </div>
                  <div class="card-header">
                    <h4 class="card-title text-center">CashBook</h4>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Sn No.
                          </th>
                          <th>
                            ID
                          </th>
                          <th>
                            Reason
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            Amount
                          </th>
                          <th>
                            Balance Estimate
                          </th>
                          <th>
                            Recorded On
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cashbook as $cbk )
                        <tr>
                          <td>{{$cbk->id}}</td>
                          <td>{{$cbk->Transaction_Id}}</td>
                          <td>{{$cbk->Description}}</td>
                          <td>Ksh {{$cbk->Crd_Amnt}}</td>
                          <td>Ksh {{$cbk->Dbt_Amt}}</td>
                          <td>Ksh {{$cbk->Bal}}</td>
                          <td>{{$cbk->created_at}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
</body>
</html>
