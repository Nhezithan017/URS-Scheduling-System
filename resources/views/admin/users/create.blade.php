@extends('layouts.dashboard')

@section('main-content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i> Create User</h6>
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
                
            </div>
              <div class="table-responsive">
              <div class="container">
                @include('layouts.errors')
                <form action="{{ route('user.create') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                
              <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" value="{{ old('username') }}"  autofocus>
                        </div>
            
                    </div>
              </div> 

              <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="{{ __('Username') }}" value="{{  old('username') }}"  autofocus>
                        </div>
            
                    </div>  
              </div> 


                    <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" value="{{ old('password') }}"  autofocus>
                                </div>
                    
                            </div>
                    </div> 
                    <div class="row">
                    <div class="col">
                    <div class="form-group">
                                    {!! Form::select('roles[]', $roles, '' , array('class' => 'form-control ','select')) !!}
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="" class="form-label">Image</label>
                            <input  type="file" class="form-control"  name="profile_image">
                         
                            </div>
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