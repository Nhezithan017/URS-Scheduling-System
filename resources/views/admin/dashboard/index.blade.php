@extends('layouts.dashboard')

@section('main-content')
  <!-- Earnings (Monthly) Card Example -->
  <div class="row">
  <div class="col-xl-3 col-md-4 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="{{ route('instructor.index') }}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Instructor</a>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $teachers }}</div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="{{ route('subject.index') }}" class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Subject</a>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $subjects }}</div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-book-reader fa-2x text-gray-300"></i>
                                    
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                           
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="{{ route('users.index') }}" class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Users</a>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="row">
  <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="{{ route('courses.index') }}" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Department </a>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $courses }}</div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-building fa-2x text-gray-300"></i>                                                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                       
                           
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="{{ route('courses.index') }}" class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Section</a>
                                             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sections }}</div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-home fa-2x text-gray-300"></i>
                                    
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="{{ route('audit.index') }}" class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                Audit Log</a>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activities }}</div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-wrench fa-2x text-gray-300"></i>
                                    
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
@endsection