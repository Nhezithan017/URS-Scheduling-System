@extends('layouts.dashboard')

@section('main-content')
@include('layouts.success')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i> Subject</h6>
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
            @can('subject-create')
              <a class="btn btn-success mb-3" href="{{ route('subject.new') }}"><i class="fas fa-fw fa-plus-square"></i></a>        
            @endcan
            </div>
              <div class="table-responsive">
              <div class="container">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Lec</th>
                            <th>Lab</th>
                            <th>Unit</th>
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
                <h4 align="center" style="margin:0;">Are you sure you want to remove this subject?</h4>
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

// Delete action

var subject_id;

$(document).on('click', '.deleteButton', function(){
    subject_id = $(this).attr('id');
    $('#deleteModal').modal('show');
});

$('#ok_button').click(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'DELETE',
        url:"/subject/" + subject_id + '/delete',
    });
        $.ajax({
            beforeSend:function(){
                $('#ok_button').text('Deleting...');
                setTimeout(function(){
                $('#deleteModal').modal('hide');
                window.location.reload();
            }, 1000);
            },
        
    });
});

    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex' },
          { data: 'code', name: 'code' },
          { data: 'description', name: 'description' },
          { data: 'lec', name: 'lec' },
          { data: 'lab', name: 'lab' },
          { data: 'unit', name: 'unit' },
          { data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });


    var user_id;




});


</script>
@endsection