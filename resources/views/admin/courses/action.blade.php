


<div class="btn-group" role="group" aria-label="Basic example">
@can('section-list')
<a href="{{ route('courses.show', $row->id) }}" class="btn btn-primary"><i class="fas fa-fw fa-plus-square"></i> Section</a>
@endcan
@can('course-edit')
    <a href=" {{ route('course.show', $row->id)  }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
@endcan
<input type="hidden" value="{{ $row->id }}" id="userId"/>
@can('course-delete')
    <button type="button" name="deleteButton" id="{{ $row->id }}" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
@endcan
<a type="button" target="_blank" href="{{ route('course.print', $row->id) }}" name="print" class="btn btn-secondary"><i class="fas fa-print"></i></a>
<a type="button" target="_blank" href="{{ route('course.room_utilization', $row->id) }}" name="room_utilization" class="btn btn-warning"><i class="fas fa-print"></i> Room</a>
</div>


                