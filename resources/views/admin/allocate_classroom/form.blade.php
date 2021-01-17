@extends('layouts.dashboard')

@section('main-content')
<style type="text/css">

</style>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i> {{ $modify == 1 ? 'Update' : 'Create' }} Allocate Classroom</h6>
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
                
            </div>
              <div class="table-responsive">
              <div class="container">
                @include('layouts.errors')
                <form action="{{ $modify == 1 ? route('allocate_classroom.update', ['allocate_classroom_id' => $allocate_classroom_id]) : route('allocate_classroom.create', $section_id ?? '') }}" method="post">
                    @csrf
                
              <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Room No.</label>
                            <input type="text" class="form-control" name="room_no" placeholder="{{ __('Room No') }}" value="{{ $allocate_classroom->room_no ?? old('room_no') }}"  autofocus>
                        </div>
            
                    </div>  
              </div> 

              <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Instructor</label>
                            <input type="text" class="form-control" name="teacher" placeholder="{{ __('Instructor') }}" value="{{ $allocate_classroom->teacher ?? old('teacher') }}"  autofocus>
                        </div>
            
                    </div>  
              </div> 

                    <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Select Days :</label><br/>
                                    <select class="selectpicker" multiple data-live-search="true" name="days[]">
                                        @foreach ($days as $key => $value)
                                                <option value="{{ $key }}"
                                                
                                                @if (in_array($key, $allocate_classroom->days ?? [] ))
                                                        selected="selected"
                                                @endif
                                                >{{ $value }}</option>
                                        @endforeach

                                    </select>     
                                </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group">
                            <label>Select Subject :</label><br/>
                                    <select class="selectsubject"  data-live-search="true" name="subject_id">
                                                    @foreach($subjects as $sub)
                                                    <option value="{{ $sub->id }}"
                                                            @if ($allocate_classroom->subject_id ?? '' == $sub->id)
                                                                    selected="selected"
                                                            @endif
                                                            >{{ $sub->description }}</option>
                                                    @endforeach

                                    </select>
                            </div>
                        </div>
                    </div> 
                    

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                             <label for="" class="form-label">Start Time:</label>              
                                    
                                <input type="text" value="{{ $allocate_classroom->start_time ?? old('start_time') }}" class="form-control" id="start_time" data-format="hh:mm:ss" data-template="hh:mm:ss" name="start_time">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                             <label for="" class="form-label">End Time:</label>                           
                                <input type="text" value="{{ $allocate_classroom->end_time ?? old('end_time') }}" class="form-control" id="end_time" data-format="hh:mm:ss" data-template="hh:mm:ss" name="end_time">
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

        $('#start_time').combodate({
        firstItem: 'name', //show 'hour' and 'minute' string at first item of dropdown
        minuteStep: 1
    });

    $('#end_time').combodate({
        firstItem: 'name', //show 'hour' and 'minute' string at first item of dropdown
        minuteStep: 1
    });
        $('select').selectpicker();
        $('.selectsubject').selectpicker();
    });

</script>
@endsection