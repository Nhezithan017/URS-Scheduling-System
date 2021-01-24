<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
    
    //dashboard
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');

    //Users
    Route::get('users', 'Admin\UserController@getUsers')->name('users.index');
    Route::get('user/create', 'Admin\UserController@createUser')->name('user.new');
    Route::post('user/create', 'Admin\UserController@createUser')->name('user.create');
    Route::get('user/{id}', 'Admin\UserController@showUser')->name('user.show');
    Route::post('user/{id}', 'Admin\UserController@updateUser')->name('user.update');
    Route::delete('user/{id}/delete', 'Admin\UserController@deleteUser')->name('user.delete');

    //Roles
    Route::get('roles', 'Admin\RoleController@getRoles')->name('role.index');
    Route::get('role/create', 'Admin\RoleController@createRole')->name('role.new');
    Route::post('role/create', 'Admin\RoleController@createRole')->name('role.create');
    Route::get('role/{id}', 'Admin\RoleController@showRole')->name('role.show');
    Route::post('role/{id}', 'Admin\RoleController@updateRole')->name('role.update');
    Route::delete('role/{id}/delete', 'Admin\RoleController@deleteRole')->name('role.delete');

    //Courses
    Route::get('courses', 'Admin\CourseController@getCourses')->name('courses.index');
    Route::get('courses/{course}/show', 'Admin\CourseController@showCourses')->name('courses.show');
    Route::get('course/create', 'Admin\CourseController@createCourse')->name('course.new');
    Route::post('course/create', 'Admin\CourseController@createCourse')->name('course.create');
    Route::get('course/{id}', 'Admin\CourseController@showCourse')->name('course.show');
    Route::post('course/{id}', 'Admin\CourseController@updateCourse')->name('course.update');
    Route::delete('course/{id}/delete', 'Admin\CourseController@deleteCourse')->name('course.delete');
    Route::get('course/{id}/print', 'Admin\CourseController@print')->name('course.print');
    Route::get('course/{id}/room_utilization', 'Admin\CourseController@room_utilization')->name('course.room_utilization');
    
    //Section
    Route::get('section/{section}/show', 'Admin\SectionController@showSections')->name('sections.show');
    Route::get('section/create/{course}', 'Admin\SectionController@createSection')->name('section.new');
    Route::post('section/create/{course}', 'Admin\SectionController@createSection')->name('section.create');
    Route::get('section/{id}', 'Admin\SectionController@showSection')->name('section.show');
    Route::post('section/{id}', 'Admin\SectionController@updateSection')->name('section.update');
    Route::delete('section/{id}/delete', 'Admin\SectionController@deleteSection')->name('section.delete');
    
    //Allocate Class Room
    Route::get('allocate_classroom/create/{section}', 'Admin\AllocateClassroomController@createAllocateClassRoom')->name('allocate_classroom.new');
    Route::post('allocate_classroom/create/{section}', 'Admin\AllocateClassroomController@createAllocateClassRoom')->name('allocate_classroom.create');
    Route::get('allocate_classroom/{id}', 'Admin\AllocateClassroomController@showAllocateClassRoom')->name('allocate_classroom.show');
    Route::post('allocate_classroom/{id}', 'Admin\AllocateClassroomController@updatellocateClassRoom')->name('allocate_classroom.update');
    Route::delete('allocate_classroom/{id}/delete', 'Admin\AllocateClassroomController@deleteAllocateClassRoom')->name('allocate_classroom.delete');

    //Instructor
    Route::get('instructors', 'Admin\TeacherController@getInstructor')->name('instructor.index');
    Route::get('instructor/create', 'Admin\TeacherController@createInstructor')->name('instructor.new');
    Route::post('instructor/create', 'Admin\TeacherController@createInstructor')->name('instructor.create');
    Route::get('instructor/{id}', 'Admin\TeacherController@showInstructor')->name('instructor.show');
    Route::post('instructor/{id}', 'Admin\TeacherController@updateInstructor')->name('instructor.update');
    Route::delete('instructor/{id}/delete', 'Admin\TeacherController@deleteInstructor')->name('instructor.delete');
    Route::get('instructor/{id}/print', 'Admin\TeacherController@print')->name('instructor.print');
    //Subjects
    Route::get('subjects', 'Admin\SubjectController@getSubject')->name('subject.index');
    Route::get('subject/create', 'Admin\SubjectController@createSubject')->name('subject.new');
    Route::post('subject/create', 'Admin\SubjectController@createSubject')->name('subject.create');
    Route::get('subject/{id}', 'Admin\SubjectController@showSubject')->name('subject.show');
    Route::post('subject/{id}', 'Admin\SubjectController@updateSubject')->name('subject.update');
    Route::delete('subject/{id}/delete', 'Admin\SubjectController@deleteSubject')->name('subject.delete');

    //Audit
    Route::get('audit', 'Admin\AuditController@getAudit')->name('audit.index');
});

Route::group(['middleware' => 'guest'], function(){
    Route::get('login', 'Auth\LoginController@loginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
});


Auth::routes();


