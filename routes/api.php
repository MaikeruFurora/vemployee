<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','AuthController@login');
Route::post('logout','AuthController@logout')->middleware('auth:sanctum');

Route::get('getTeacher','TeacherController@index');
Route::post('storeTeacher','TeacherController@store');
Route::put('updateTeacher','TeacherController@update');
Route::delete('deleteTeacher/{teacher}','TeacherController@destroy');
Route::get('searchTeacher/{field}/{query}','TeacherController@search');
Route::get('getCurrentTeacher/{teacher}','TeacherController@show');
Route::get('liveSearch','TeacherController@liveSearch');

Route::get('getRecords/{id}','RecordController@show');
Route::post('storeRecord','RecordController@store');
Route::delete('destroyRecord/{id}','RecordController@destroy');
Route::get('editRecord/{record}','RecordController@edit');
Route::put('updateRecord','RecordController@update');
Route::get('getExcelRecord/{teacher}','DownloadController@xslx_export');
Route::get('getLawop/{id}','RecordController@lawop');