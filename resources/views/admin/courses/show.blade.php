@extends('layouts.dashboard')

@section('main-content')
@include('layouts.success')

<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Show</h6>
            </div>
            <div class="card-body">
            <div class="container">
  <div class="row gy-5">
    <div class="col">
    <div class="p-3 border bg-light">Description:  <b>{{ $course->description }}</b></div>
    </div>

  </div>
  <div class="row gy-5 mt-2">
    <div class="col-6">
      <div class="p-3 border bg-light">Sy: <b>{{ $course->sy_start }}</b>-  <b>{{ $course->sy_end }}</b></div>
    </div>
    <div class="col-6">
      <div class="p-3 border bg-light">Semester:  <b>{{ $course->semester }}</b></div>
    </div>
  </div>
</div>
            </div>  
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
            @can('section-create')
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i> Section</h6>
            @endcan
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
              <a class="btn btn-success mb-3" href="{{ route('section.new', $course->id) }}"><i class="fas fa-fw fa-plus-square"></i></a>        
            </div>
              <div class="table-responsive">
              <div class="container">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Adviser</th>
                            <th>Year</th>
                            <th>Section</th>
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
  var section_id;

// Delete action
$(document).on('click', '.deleteButton', function(){
    section_id = $(this).attr('id');
    $('#deleteModal').modal('show');
});
    
$('#ok_button').click(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'DELETE',
        url:"/section/" + section_id + '/delete',
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
          { data: 'adviser', name: 'adviser' },
          { data: 'year', name: 'year' },
          { data: 'section', name: 'section' },
          { data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });




});


</script>
@endsection