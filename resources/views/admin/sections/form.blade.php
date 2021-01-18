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
                    <div class="col">
                        <div class="form-group">
                        <label for="" class="form-label">Adviser</label>
                            <input type="text" class="form-control" name="adviser" placeholder="{{ __('Adviser') }}" value="{{ $sections->adviser ?? old('adviser') }}"  autofocus>
                        </div>
            
                    </div>  
              </div> 

              <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="form-label">Section:</label>       
                            <select class="selectsection"  data-live-search="true" name="section">
                                                <option disabled selected>--Select Section--</option>
                                                @foreach ($section as $value)
                                                        <option value="{{ $value }}"
                                                        
                                                        @if ($sections->section ?? '' == $value)
                                                                selected="selected"
                                                        @endif
                                                        >{{ $value }}</option>
                                                @endforeach

                                   </select>
                        
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="" class="form-label">Year</label>
                                <select class="selectyear"  data-live-search="true" name="year">
                                <option disabled selected>--Select Year--</option>
                                             @foreach ($year as $value)
                                                        <option value="{{ $value }}"
                                                        
                                                        @if ($sections->year ?? '' == $value)
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
    });

</script>
@endsection