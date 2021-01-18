@extends('layouts.dashboard')

@section('main-content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i> {{ $modify == 1 ? 'Update' : 'Create' }} Instructor</h6>
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
                
            </div>
              <div class="table-responsive">
              <div class="container">
                @include('layouts.errors')
                <form action="{{ $modify == 1 ? route('instructor.update', [ 'instructor_id' => $instructor_id ]) : route('instructor.create') }}" method="post">
                    @csrf
                
              <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" value="{{ $instructor->name ?? old('name') }}"  autofocus>
                        </div>
            
                    </div>
              </div> 

              <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Degree</label>
                            <input type="text" class="form-control" name="degree" placeholder="{{ __('Degree') }}" value="{{ $instructor->degree ?? old('degree') }}"  autofocus>
                        </div>
            
                    </div>  
              </div> 


                    <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label for="" class="form-label">Educational Status</label>
                                    <input type="text" class="form-control" name="educ_status" placeholder="{{ __('Educational Status') }}" value="{{ $instructor->educ_status ?? old('educ_status') }}"  autofocus>
                                </div>
                    
                            </div>
                    </div> 

                    <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label for="" class="form-label">Position Title</label>
                                    <input type="text" class="form-control" name="position_title" placeholder="{{ __('Position Title') }}" value="{{ $instructor->position_title ?? old('position_title') }}"  autofocus>
                                </div>
                    
                            </div>
                    </div> 

                    <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label for="" class="form-label">Nature of Appointment</label>
                                    <input type="text" class="form-control" name="nature_of_appoint" placeholder="{{ __('Nature of Appointment') }}" value="{{ $instructor->nature_of_appoint ?? old('nature_of_appoint') }}"  autofocus>
                                </div>
                    
                            </div>
                    </div> 

                    <div class="justify-content-between">
                    <a type="button" href="{{ route('instructor.index') }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
               
              </div>
            </div>  
          </div>
@endsection