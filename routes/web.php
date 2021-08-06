<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/home');
    })->middleware('auth');



Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);
Route::resource('company', 'CompanyCRUDController')->middleware('auth');
Route::resource('employee', 'EmployeeCRUDController')->middleware('auth');
Route::get('department/list', 'DepartmentController@list')->name('department.home')->middleware('auth'); // for listing departments
Route::get('department/add', 'DepartmentController@addDepartment')->name('department.add')->middleware('auth'); // for add
Route::post('department/store', 'DepartmentController@store')->middleware('auth');
Route::get('department/edit/{dept_id}', 'DepartmentController@edit')->name('department.edit')->middleware('auth'); // for edit 
Route::delete('department/delete/{dept_id}', 'DepartmentController@delete')->name('department.delete')->middleware('auth'); // for delete 


Route::get('/home', 'HomeController@index')->name('home');
