    <!-- Divider -->
    <hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    SETUP
</div>

<!-- Barangay Profile -->
<li class="nav-item">

<a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#departmentProfile" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-fw fa-users"></i>
  <span>Department Profile</span>
</a>

<div id="departmentProfile" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
  <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Custom Utilities:</h6>
    <a class="collapse-item" href="">Settings</a>
  </div>
</div>
</li>


<!-- User  -->
<li class="nav-item">
<a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-fw fa-user"></i>
  <span>User Management</span>
</a>
<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
  <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Custom Utilities:</h6>
    <a class="collapse-item" href="{{ route('users.index') }}">Users</a>
   
  </div>  
</div>
</li>

<!-- Tools  -->
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

<!-- Tools  -->
<li class="nav-item">
<a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#subject" aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-book-reader"></i>
  <span>Subjects</span>
</a>
<div id="subject" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
  <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Custom Utilities:</h6>
    <a class="collapse-item" href="">Subject</a> 
  </div>  
</div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">