    <!-- Divider -->
    <hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    SETUP
</div>

<!-- Barangay Profile -->
<li class="nav-item">

<a class="nav-link collapsed" href="{{ route('dashboard') }}" data-toggle="collapse" data-target="#departmentProfile" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-hamburger"></i>
  <span>Dashboard</span>
</a>

<div id="departmentProfile" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
  <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Custom Utilities:</h6>
    <a class="collapse-item" href="{{ route('dashboard') }}">Dashboard</a>
  </div>
</div>
</li>


<!-- User  -->
@can('user-list')
<li class="nav-item">
<a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-fw fa-users"></i>
  <span>User Management</span>
</a>
<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
  <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Custom Utilities:</h6>
    <a class="collapse-item" href="{{ route('users.index') }}">Users</a>
   
  </div>  
</div>
</li>
@endcan

<!-- Teacher  -->
@can('role-list')
<li class="nav-item">
<a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#roles" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-shield-alt"></i>
  <span>Roles</span>
</a>
<div id="roles" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
  <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Custom Utilities:</h6>
    <a class="collapse-item" href="{{ route('role.index') }}">Role</a> 
  </div>  
</div>
</li>

@endcan
<!-- Tools  -->
@can('course-list')
<li class="nav-item">
<a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#course" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-building"></i> 
  <span>Course Department</span>
</a>
<div id="course" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
  <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Custom Utilities:</h6>
    <a class="collapse-item" href="{{ route('courses.index') }}">Courses</a> 
  </div>  
</div>
</li>
@endcan
<!-- Tools  -->
@can('subject-list')
<li class="nav-item">
<a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#subject" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-book-reader"></i>
  <span>Subjects</span>
</a>
<div id="subject" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
  <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Custom Utilities:</h6>
    <a class="collapse-item" href="{{ route('subject.index') }}">Subject</a> 
  </div>  
</div>
</li>
@endcan

<!-- Teacher  -->
@can('instructor-list')
<li class="nav-item">
<a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#teacher" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-chalkboard-teacher"></i>
  <span>Instructors</span>
</a>
<div id="teacher" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
  <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Custom Utilities:</h6>
    <a class="collapse-item" href="{{ route('instructor.index') }}">Instructor</a> 
  </div>  
</div>
</li>
@endcan

<!-- Teacher  -->
@can('audit-list')
<li class="nav-item">
<a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#audit" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-wrench"></i>
  <span>Auditory</span>
</a>
<div id="audit" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
  <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Custom Utilities:</h6>
    <a class="collapse-item" href="{{ route('audit.index') }}">Audit</a> 
    <a class="collapse-item" href="/env-editor">System Environment</a> 
  </div>  
  
</div>
@endcan
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">