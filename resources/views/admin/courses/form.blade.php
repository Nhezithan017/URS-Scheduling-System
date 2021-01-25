@extends('layouts.dashboard')

@section('main-content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i> {{ $modify == 1 ? 'Update' : 'Create' }} Course</h6>
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
                
            </div>
              <div class="table-responsive">
              <div class="container">
                @include('layouts.errors')
                <form action="{{ $modify == 1 ? route('course.update', [ 'course_id' => $course_id ]) : route('course.create') }}" method="post">
                    @csrf
                
              <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Department</label>
                            <select class="form-control" name="description">
                            <option disabled selected>--Select Course--</option>
                            @foreach($department as $key => $value)
                            <option value="{{ $value }}"
                                    @if (($course->description ?? '') == $value)
                                            selected="selected"
                                    @endif
                                    >{{ $value }}</option>
                                
                            @endforeach
                            </select>
                        </div>
            
                    </div>
              </div> 

              <div class="row">
                         <div class="col">
                            <div class="form-group">
                             <label for="" class="form-label">Sy - Start</label>              
                                    
                                <input type="text" value="{{ $course->sy_start  ?? old('sy_start') }}" class="form-control" id="sy_start" data-format="YYYY" data-template="YYYY" name="sy_start">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                             <label for="" class="form-label">Sy - End</label>              
                                    
                                <input type="text" value="{{ $course->sy_end ?? old('sy_end') }}" class="form-control" id="sy_end" data-format="YYYY" data-template="YYYY" name="sy_end">
                            </div>
                        </div>
              </div> 


                    <div class="row">
                            <div class="col">
                                <div class="form-group">
                                <label for="" class="form-label">Semester</label>
                                    <select class="form-control" name="semester">
                                            <option disabled selected>--Select Semester--</option>
                                                 @foreach($semester as $sem)
                                                    <option value="{{ $sem }}"
                                                            @if ($sem == ($course->semester ?? ''))
                                                                    selected="selected"
                                                            @endif
                                                            >{{ $sem }}</option>
                                                    @endforeach
                                    </select>
                                </div>
                    
                            </div>
                    </div> 
                    <div class="justify-content-between">
                    <a type="button" href="{{ route('courses.index') }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
               
              </div>
            </div>  
          </div>

          <script type="text/javascript">

    $(document).ready(function() {

        $('#sy_start').combodate({
                firstItem: 'name',
                yearDescending: false,
                minYear: 2020,
                maxYear: 2050
    });


        $('#sy_end').combodate({
            firstItem: 'name',
            yearDescending: false,
            minYear: 2020,
            maxYear: 2050
        });
        
    });

</script>
@endsection