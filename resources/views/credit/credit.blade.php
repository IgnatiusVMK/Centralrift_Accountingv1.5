@extends('layouts.app')
@section('content')
<div class="col-sm-12">
  <div class="home-tab">
    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
        </li>
      </ul>
      <div>
        <div class="btn-wrapper">
          <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
          {{-- <a href="{{ url('customer/'.$cust_id.'/generate-groupedinvoice') }}" class="btn btn-success"><i class="icon-printer"></i>Generate Invoice</a> --}}
          <a href="#" class="btn btn-success" data-toggle="modal" data-target="#creditNoteModal">
            <i class="icon-printer"></i> CreditNote Cluster
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-danger text-center">{{session('status')}}</div>
                    @endif
                  <div class="card-header">
                  <h4 class="card-title">Creditors/Credit
                    <a href="{{ url('credit/create') }}" class="btn btn-primary float-end">+ Record New Credit</a>
                  </h4>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Sn No.
                          </th>
                          <th>
                            Credit ID
                          </th>
                          <th>
                            Source
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            Amount
                          </th>
                          <th>
                            Remarks
                          </th>
                          <th>
                            Date
                          </th>
                          <th>
                            Generate Credit Note
                        </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($credits as $cred )
                        <tr>
                          <td>{{$cred->id}}</td>
                          <td>{{$cred->Credit_Id}}</td>
                          <td>{{$cred->Source}}</td>
                          <td>{{$cred->Description}}</td>
                          <td>Ksh {{$cred->Amount}}</td>
                          <td>{{$cred->Remarks}}</td>
                          <td>{{$cred->created_at}}</td>
                          <td>
                            <a href="{{ ('/credit'.'/'.$cred->Credit_Id.'/generate-credit-note') }}" {{-- class="btn btn-otline-dark" --}}>
                              <button type="submit" class="btn btn-primary text-white me-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                  <path d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z"/>
                                  <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103"/>
                                </svg>
                                Credit Note
                              </button>
                            </a>
                          </td>
                          <td>
                            {{-- <a href="{{ url('credit/credit/'.$cred->id.'/edit')}}" class="btn btn-warning"><i class="mdi mdi-border-color"></i> Edit</a> --}}
                            {{-- <a href="{{ url('credancials/expenditures/'.$cred->id.'/delete')}}" class="btn btn-danger">Delete <i class="mdi mdi-shredder"></i></a> --}}
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{-- <div class="pagination-container">
                      {{ $financials->links() }}
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <div class="modal fade" id="creditNoteModal" tabindex="-1" role="dialog" aria-labelledby="creditNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="creditNoteModalLabel">Enter Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="creditNoteForm" action="{{ url('credit/generate-grouped-CreditNote') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="Credit_Date">Date</label>
                        <input type="date" class="form-control" id="Credit_Date" name="Credit_Date" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitCredit">Submit</button>
            </div>
        </div>
    </div>
</div>


<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.getElementById('submitCredit').addEventListener('click', function() {
      document.getElementById('creditNoteForm').submit();
  });
</script>
@endsection
