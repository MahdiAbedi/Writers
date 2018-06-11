<?php

use App\Halghe;

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

Route::get('/','HomeController@dashboard');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard');

######################<< حلقه ها >>############################################

Route::resource('halghe', 'HalgheController');

######################<< یادداشت ها >>#########################################
//یادداشتهای نهایی شده
//این مسیر باید بالاتر از روتهای دیگه باشه
Route::get('/notes/final','NoteController@finalNotes');

Route::resource('notes', 'NoteController');
//مشاهده یادداشتهای در انتظار تعیین ناظر محتوایی
Route::get('/set-nazer','NoteController@withoutNazer');
//انتخاب ناظر محتوایی توسط مدیر حلقه برای یادداشت
Route::get('/set-nazer/{id}','NoteController@setNazer');
//ذخیره امتیاز ارزیابی برای هر یادداشت
Route::post('/arzyabi/store','NoteController@savePoint')->name('arzyabi.store');
//ارزیابی یادداشت
Route::get('/arzyabi/{id}','NoteController@arzyabi');

//انتخاب سوژه توسط کاربر
Route::get('/choosesuzhe/{id}','NoteController@chooseSuzhe');
//مشاهده یادداشتهای در انتظار بررسی محتوایی

//مشاهده یادداشتهای در انتظار ارزیابی
Route::get('/arzyabi','NoteController@listArzyabi');
//مشاهده لیست یادداشتهای در انتظار بررسی محتوایی
Route::get('/barrasi','NoteController@listBarrasi');
//یادداشتهای منتشر شده در رسانه ها
Route::get('/montashershode','NoteController@montashershode');
//مشاهده تاریخچه یادداشتها
Route::get('/history/{id}','NoteController@showNoteHistory');

######################<< سوژه ها >>############################################

Route::resource('suzhe', 'SuzheController');
Route::get('/suzhe/{id}/reject','SuzheController@reject');
// Route::get('/suzhe/{id}/publish','SuzheController@publish');
######################<< کاربران >>############################################

Route::resource('users','UserController');
//مشاهده تاریخچه امتیازات کاربر
Route::get('user/history/{id}','UserController@showHistory');


######################<< بررسی توسط ناظر محتوایی >>############################

Route::resource('nazer','NazerController');
Route::get('/nazer/create/{id}','NazerController@create');

######################<< رسانه ها >>############################
//ذخیره یادداشت در رسانه ها
Route::post('media/storeMediaForNote','MediaController@storeMediaForNote')->name('media.storeMediaForNote');
Route::resource('media','MediaController');
//یادداشتهای در انتظار انتشار در رسانه ها
Route::get('waiting','MediaController@waiting');
//ثبت لینک یادداشت در خبرگزاری
Route::post('submiturl','MediaController@seturl')->name('media.submiturl');
//مشاهده صفحه ثبت لینک یادداشت در رسانه ها در این حالت باید شناسه یادداشت و رسانه را داشته باشیم
Route::get('sabt/{note_id}/{media_id}','MediaController@showsabt');
