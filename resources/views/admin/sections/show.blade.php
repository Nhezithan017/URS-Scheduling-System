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
    <div class="col-4">
      <div class="p-3 border bg-light">Adviser:  <b>{{ $section->adviser }}</b></div>
    </div>
    <div class="col-4">
    <div class="p-3 border bg-light">Year:  <b>{{ $section->year }}</b></div>
    </div>
    <div class="col-4">
      <div class="p-3 border bg-light">Section:  <b>{{ $section->section }}</b></div>
    </div>
  </div>
</div>
            </div>  
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i> Allocate Room</h6>
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
            @can('allocate_classroom-create')
              <a class="btn btn-success mb-3" href="{{ route('allocate_classroom.new', $section->id) }}"><i class="fas fa-fw fa-plus-square"></i></a>        
           @endcan
            </div>
              <div class="table-responsive">
              <div class="container">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Room No.</th>
                            <th>Instructor</th>
                            <th>Days</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Subject</th>
                            <th>Status</th>
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
                <h4 align="center" style="margin:0;">Are you sure you want to remove this allocate of room?</h4>
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

  var allocate_classroom;
  $(document).on('click', '.deleteButton', function(){
    allocate_classroom = $(this).attr('id');
    $('#deleteModal').modal('show');
});

$('#ok_button').click(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'DELETE',
        url:"/allocate_classroom/" + allocate_classroom + '/delete',
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
          { data: 'room_no', name: 'room_no' },
          { data: 'instructor', name: 'instructor' },
          { data: 'days', name: 'days' },
          { data: 'start_time', name: 'start_time' },
          { data: 'end_time', name: 'end_time' },
          { data: 'subject', name: 'subject' },
          { data: 'status', name: 'status' },
          { data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });




});


</script>
@endsection