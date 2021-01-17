@extends('layouts.dashboard')

@section('main-content')
@include('layouts.success')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-reading-books"></i> Subject</h6>
            </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
              <a class="btn btn-success mb-3" href="{{ route('subject.new') }}"><i class="fas fa-fw fa-plus-square"></i></a>        
            </div>
              <div class="table-responsive">
              <div class="container">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
              </div>
            </div>  
          </div>

 

 <!-- Modal -->
 <div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this section?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


$(document).ready(function(){

    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'name', name: 'name' },
          { data: 'username', name: 'username' },
          { data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });


    


});


</script>
@endsection