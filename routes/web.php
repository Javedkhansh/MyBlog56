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

Route::get('/', 'BlogController@index');

Auth::routes();

//blog routes
Route::get('/blogs', 'BlogController@index')->name('blogs');
Route::get('/blogs/create', 'BlogController@create')->name('blogs.create');
Route::post('/blogs/store', 'BlogController@store')->name('blogs.store');

  //----------------------------------------------------------------------------------- //
 //                            | Trashed Routes |                              //
//----------------------------------------------------------------------------------- //
Route::get('/blogs/trash', 'BlogController@trash')->name('blogs.trash');
Route::get('/blogs/trash/{id}/restore', 'BlogController@restore')->name('blogs.restore');
Route::delete('/blogs/trash/{id}/permanent-delete', 'BlogController@permanentDelete')->name('blogs.permanent-delete');

Route::get('/blogs/{id}', 'BlogController@show')->name('blogs.show');
Route::get('/blogs/{id}/edit', 'BlogController@edit')->name('blogs.edit');
Route::patch('/blogs/{id}/update', 'BlogController@update')->name('blogs.update');
Route::delete('/blogs/{id}/delete', 'BlogController@delete')->name('blogs.delete');

  //----------------------------------------------------------------------------------- //
 //                            | Admin Controller Routs |                              //
//----------------------------------------------------------------------------------- //
Route::get('/dashboard','AdminController@index')->name('dashboard');
//we can use middleware like this, but we can use its in controller.
// Route::get('/admin','AdminController@index')->name('admin.index')->middleware(['admin','auth']);
Route::get('/admin/blogs','AdminController@blogs')->name('admin.blogs');


//Route Resoucrce of Category
Route::resource('/categories', 'CategoryController');
//Rotue resource of users
Route::resource('users','UserController');