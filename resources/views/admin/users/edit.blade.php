@extends('layouts.dashboard')

@section('main-content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i>Update Users</h6>
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
                
            </div>
              <div class="table-responsive">
              <div class="container">
                @include('layouts.errors')
                <form method="POST" action="{{ route ('user.update', $user->id) }}">
                    @csrf
                    @method('PATCH')
              <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" value="{{ $user->name ?? old('name') }}"  autofocus>
                        </div>
            
                    </div>
              </div> 

              <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="{{ __('Username') }}" value="{{ $user->username ?? old('username') }}"  autofocus>
                        </div>
            
                    </div>
              </div> 


                    <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="{{ __('Email') }}" value="{{ $user->email ?? old('email') }}"  autofocus>
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