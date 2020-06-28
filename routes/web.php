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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', 'StudentsController@index');
Route::resource('/students', 'StudentsController')->except(['show']);
Route::get('/students/{student}', 'StudentsController@show');
Route::get('/student/{student_id}/edit_password', 'StudentsController@edit_password_from_service');
Route::patch('/student/password/{student_id}/', 'StudentsController@update_password_from_service');
Route::get('/students/create_subjects/{student_id}', 'StudentsController@create_subject');
Route::post('/students/add_subjects/{student_id}', 'StudentsController@store_subject');
Route::delete('/subjects/{subject_id}/{student_id}', 'StudentsController@destroy_subject');
Route::get('/student/profile', 'StudentsController@profile');
Route::get('/user/edit_password', 'StudentsController@edit_password');
Route::patch('/student/password', 'StudentsController@update_password');
Route::get('/register_exam', 'StudentsController@register_exam');
Route::post('/exam', 'StudentsController@store_exam');
Route::get('/student/{student_id}/edit_account_balance', 'StudentsController@edit_balance');
Route::patch('/student/balance/{student_id}', 'StudentsController@update_balance');
Route::get('/student/{student_id}/{subject_id}/edit', 'StudentsController@edit_exam_mark');
Route::patch('/mark/{student_id}/{subject_id}', 'StudentsController@update_exam_mark');
Route::get('/exams_history', 'StudentsController@show_exams_history');

Route::resource('/professors', 'ProfessorsController');
Route::get('/professor/{professor_id}/edit_password', 'ProfessorsController@edit_password_from_service');
Route::patch('/professor/password/{professor_id}/', 'ProfessorsController@update_password_from_service');
Route::get('/professors/create_subjects/{professor_id}', 'ProfessorsController@create_subject');
Route::post('/professors/add_subjects/{professor_id}', 'ProfessorsController@store_subject');
Route::delete('/professor_subjects/{subject_id}/{professor_id}', 'ProfessorsController@destroy_subject');
Route::get('/professor/profile', 'ProfessorsController@profile');
Route::get('/professor/edit_password', 'ProfessorsController@edit_password');
Route::patch('/professor/password', 'ProfessorsController@update_password');

Route::resource('/subjects', 'SubjectsController');
Route::get('/exam_options', 'SubjectsController@edit_options');
Route::patch('/options', 'SubjectsController@update_options');


