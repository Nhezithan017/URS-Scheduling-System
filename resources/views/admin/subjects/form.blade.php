@extends('layouts.dashboard')

@section('main-content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-fw fa-user"></i> {{ $modify == 1 ? 'Update' : 'Create' }} Subject</h6>
            </div>
            <div class="card-body">
            <div class="d-flex justify-content-between">
                
            </div>
              <div class="table-responsive">
              <div class="container">
                @include('layouts.errors')
                <form action="{{ $modify == 1 ? route('subject.update', [ 'subject_id' => $subject_id ]) : route('subject.create') }}" method="post">
                    @csrf
                
              <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                        <label for="" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="{{ __('Description') }}" value="{{ $subject->description ?? old('description') }}"  autofocus>
                        </div>
            
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                        <label for="" class="form-label">Code</label>
                            <input type="text" class="form-control" name="code" placeholder="{{ __('Code') }}" value="{{ $subject->code ?? old('code') }}"  autofocus>
                        </div>
            
                    </div>
              </div> 

              <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                        <label for="" class="form-label">Lecture</label>
                           <select name="lec" class="form-control">
                            <option disabled selected>--Select Lec--</option>
                                @foreach($lec as  $value)
                                <option value="{{ $value }}"
                                        @if ($subject->lec ?? '' == $value)
                                                selected="selected"
                                        @endif
                                        >{{ $value }}</option>
                                    
                                @endforeach
                            </select>
                        </div>
            
                    </div>  

                    <div class="col-4">
                        <div class="form-group">
                        <label for="" class="form-label">Laboratory</label>
                           <select name="lab" class="form-control">
                            <option disabled selected>--Select Lab--</option>
                                @foreach($lab as  $value)
                                <option value="{{ $value }}"
                                        @if ($subject->lab?? '' == $value)
                                                selected="selected"
                                        @endif
                                        >{{ $value }}</option>
                                    
                                @endforeach
                            </select>
                        </div>
            
                    </div>  

                    <div class="col-4">
                        <div class="form-group">
                        <label for="" class="form-label">Unit</label>
                           <select name="unit" class="form-control">
                            <option disabled selected>--Select Unit--</option>
                                @foreach($unit as  $value)
                                <option value="{{ $value }}"
                                        @if ($subject->unit ?? '' == $value)
                                                selected="selected"
                                        @endif
                                        >{{ $value }}</option>
                                    
                                @endforeach
                            </select>
                        </div>
            
                    </div>  
              </div> 


                    
                    <div class="justify-content-between">
                    <a type="button" href="{{ route('subject.index') }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
               
              </div>
            </div>  
          </div>
@endsection