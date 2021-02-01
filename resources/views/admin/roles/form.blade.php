@extends('layouts.dashboard')

@section('main-content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i> {{ $modify == 1 ? 'Update' : 'Create' }} Role</h6>
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
                
            </div>
              <div class="table-responsive">
              <div class="container">
                @include('layouts.errors')
                <form action="{{ $modify == 1 ? route('role.update', [ 'role_id' => $role_id ]) : route('role.create') }}" method="post">
                    @csrf
                
              <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" value="{{ $role->name ?? old('username') }}"  autofocus>
                        </div>
            
                    </div>
              </div> 

              <div class="row">
                    <div class="col">
                    <div class="form-group">
                                    <strong>Permission:</strong>
                                        <br/>
                                        @foreach($permission as $value)

                                            <label>{{ Form::checkbox('permission[]', $value->id,  $modify === 1 ? (in_array($value->id, $role_permissions) ? true : false) : false , array('class' => 'name')) }}
                                            {{ str_replace('-', ' ',$value->name) }}</label>
                                        <br/>
                                        @endforeach
                                    </div>
            
                    </div>  
              </div> 


                    <div class="justify-content-between">
                    <a type="button" href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
               
              </div>
            </div>  
          </div>
@endsection