<div class="btn-group" role="group" aria-label="Basic example">
@can('instructor-edit')
    <a href=" {{ route('instructor.show', $row->id)  }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
@endcan
<input type="hidden" value="{{ $row->id }}" id="userId"/>
@can('instructor-delete')
    <button type="button" name="deleteButton" id="{{ $row->id }}" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
@endcan
<a type="button" target="_blank" href="{{ route('instructor.print', $row->id) }}" name="print" class="btn btn-secondary"><i class="fas fa-print"></i></a>
</div>

                