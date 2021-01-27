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
                    <div class="col-6">
                        <div class="form-group">
                        <label>Room No :</label><br/>
                                    <select class="selectrooms"  data-live-search="true" name="room_no">
                                        <option disabled selected>--Select Room No--</option>
                                        @foreach ($rooms as $value)
                                                <option value="{{ $value }}"
                                                
                                                @if ($value == ($allocate_classroom->room_no ?? ''))
                                                        selected="selected"
                                                @endif
                                                >{{ $value }}</option>
                                        @endforeach

                                    </select>    
                        </div>
            
                    </div>  

                    <div class="col-6">
                        <div class="form-group">
                        <label>Instructor :</label><br/>
                                    <select class="selectinstructor"  data-live-search="true" name="teacher_id">
                                                <option disabled selected>--Select Instructor--</option>
                                        @foreach ($instructors as $value)
                                                <option value="{{ $value->id }}"
                                                
                                                @if ($value->id == ($allocate_classroom->teacher_id ?? ''))
                                                        selected="selected"
                                                @endif
                                                >{{ $value->name }}</option>
                                        @endforeach

                                    </select>    
                        </div>
            
                    </div>  

              </div> 


                    <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label>Select Days: </label><br/>
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
                            <label>Subject :</label><br/>
                                    <select class="selectsubject"  data-live-search="true" name="subject_id">
                                                    <option disabled selected>--Select  Subject--</option>
                                                    @foreach($subjects as $sub)
                                                    <option value="{{ $sub->id }}"
                                                            @if ($sub->id == ($allocate_classroom->subject_id ?? ''))
                                                                    selected="selected"
                                                            @endif
                                                            >{{ $sub->description }}</option>
                                                    @endforeach

                                    </select>
                            </div>
                        </div>
                    </div> 
                    <div class=row>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="form-label">Year:</label><br/>
                                <select class="selectyear"  data-live-search="true" name="year">
                                <option disabled selected>--Select Year--</option>
                                             @foreach ($year as $value)
                                                        <option value="{{ $value }}"
                                                        
                                                        @if ($value == ($allocate_classroom->year ?? ''))
                                                                selected="selected"
                                                        @endif
                                                        >{{ $value }}</option>
                                                @endforeach
                                </select>
                            
                        </div>
                    </div>
                      
                        <div class="col-6">
                        <div class="form-group">
                            <label for="" class="form-label">Section:</label><br/>       
                            <select class="selectsection"  data-live-search="true" name="section">
                                                <option disabled selected>--Select Section--</option>
                                                @foreach ($section as $value)
                                                        <option value="{{ $value }}"
                                                        
                                                        @if ($value == ($allocate_classroom->section ?? ''))
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
                             <label for="" class="form-label">Start Time:</label>              
                                    
                                <input type="time" value="{{ $allocate_classroom->start_time ?? old('start_time') }}" class="form-control" name="start_time">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                             <label for="" class="form-label">End Time:</label>                           
                                <input type="time" value="{{ $allocate_classroom->end_time ?? old('end_time') }}" class="form-control"  name="end_time">
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                             <label for="" class="form-label">Class Size:</label>                           
                                <select name="class_size"  class="form-control">
                                @foreach ($class_size as $value)
                                                        <option value="{{ $value }}"
                                                        
                                                        @if ($value == ($allocate_classroom->class_size ?? ''))
                                                                selected="selected"
                                                        @endif
                                                        >{{ $value }}</option>
                                                @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
                  @if(auth()->id() === 1)
                    <div class="form-group">
                                    <label class="form-group-label d-block"> <strong>Status:</strong></label>
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ $modify === 1 ? ($allocate_classroom->status ? 'checked' : '') : '' }} checked>
                                        <label class="form-check-label" for="inlineRadio1">Approve</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" {{ $modify === 1 ? (!$allocate_classroom->status ? 'checked' : '') : ''}}>
                                        <label class="form-check-label" for="inlineRadio2">Dis-Approve</label>
                                        </div>
                                    </div>
                    @endif
                    <div class="justify-content-between">
                    <a type="button" href="{{ url("/section/{$section_id}/show") }}" class="btn btn-danger">Cancel</a>
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
        $('.selectrooms').selectpicker();
        $('.selectinstructor').selectpicker();
    });

</script>
@endsection