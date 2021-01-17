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


    //Courses
    Route::get('courses', 'Admin\CourseController@getCourses')->name('courses.index');
    Route::get('courses/{course}/show', 'Admin\CourseController@showCourses')->name('courses.show');
    Route::get('course/create', 'Admin\CourseController@createCourse')->name('course.new');
    Route::post('course/create', 'Admin\CourseController@createCourse')->name('course.create');
    Route::get('course/{id}', 'Admin\CourseController@showCourse')->name('course.show');
    Route::post('course/{id}', 'Admin\CourseController@updateCourse')->name('course.update');
    Route::delete('course/{id}/delete', 'Admin\CourseController@deleteCourse')->name('course.delete');
    
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


});

Route::group(['middleware' => 'guest'], function(){
    Route::get('login', 'Auth\LoginController@loginForm');
    Route::post('login', 'Auth\LoginController@login');
});


Auth::routes();


