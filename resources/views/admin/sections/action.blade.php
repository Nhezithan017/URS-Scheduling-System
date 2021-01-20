<div class="btn-group" role="group" aria-label="Basic example">
@can('allocate_classroom-list')
<a href=" {{ route('sections.show', $row->id) }}" class="btn btn-primary"><i class="fas fa-fw fa-plus-square"></i> Subject</a>
@endcan
@can('section-edit')
    <a href=" {{ route('section.show', $row->id)  }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
@endcan
<input type="hidden" value="{{ $row->id }}" id="userId"/>
@can('section-delete')
    <button type="button" name="deleteButton" id="{{ $row->id }}" class="btn btn-danger  deleteButton"><i class="fas fa-trash-alt"></i></button>
@endcan
</div>


                