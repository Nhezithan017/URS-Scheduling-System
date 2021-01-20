<div class="btn-group" role="group" aria-label="Basic example">
@can('user-edit')
    <a href=" {{ route('user.show', $row->id)  }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
@endcan
<input type="hidden" value="{{ $row->id }}" id="userId"/>
@can('user-delete')
    <button type="button" name="deleteButton" id="{{ $row->id }}" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
@endcan
</div>

                