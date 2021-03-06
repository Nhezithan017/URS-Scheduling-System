@extends('layouts.dashboard')

@section('main-content')
<style type="text/css">

</style>
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i> {{ $modify == 1 ? 'Update' : 'Create' }} Section</h6>
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
                
            </div>
              <div class="table-responsive">
              <div class="container">
                @include('layouts.errors')
                <form action="{{ $modify == 1 ? route('section.update', ['section_id' => $section_id]) : route('section.create', $course_id ?? '') }}" method="post">
                    @csrf

              <div class="row">
              <div class="col-4">
                    <div class="form-group">
                    <label for="" class="form-label">Adviser:</label>       
                                    <select class="selectinstructor"  data-live-search="true" name="adviser">
                                                <option disabled selected>--Select Adviser--</option>
                                        @foreach ($instructors as $value)
                                                <option value="{{ $value->name }}"
                                                
                                                @if ($value->name == ($sections->adviser ?? ''))
                                                        selected="selected"
                                                @endif
                                                >{{ $value->name }}</option>
                                        @endforeach

                                    </select>    
                        </div>
                    </div>  
                    <div class="col-4">
                    <div class="form-group">
                            <label for="" class="form-label">Year:</label>
                                <select class="selectyear"  data-live-search="true" name="year">
                                <option disabled selected>--Select Year--</option>
                                             @foreach ($year as $value)
                                                        <option value="{{ $value }}"
                                                        
                                                        @if ($value == ($sections->year ?? ''))
                                                                selected="selected"
                                                        @endif
                                                        >{{ $value }}</option>
                                                @endforeach
                                </select>
                            
                        </div>
                    </div>  
                    <div class="col-4">
                    <div class="form-group">
                            <label for="" class="form-label">Section:</label>    
                            <select class="selectsection"   data-live-search="true" name="description">
                                               
                                                @foreach ($section as $value)
                                                        <option value="{{ $value }}"
                                                        @if ($value == ($sections->description ?? ''))
                                                    
                                                                selected="selected"
                                                        @endif
                                                        >{{ $value }}</option>
                                                @endforeach

                                   </select>
                        
                        </div>
                    </div>
                   
              </div> 

                   
        
                    
                    <div class="justify-content-between">
                    <a type="button" href="{{ url("/courses/{$course_id}/show") }}" class="btn btn-danger">Cancel</a>
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
        $('.selectsection').selectpicker();
        $('.selectyear').selectpicker();
        $('.selectinstructor').selectpicker();
    });

</script>
@endsection