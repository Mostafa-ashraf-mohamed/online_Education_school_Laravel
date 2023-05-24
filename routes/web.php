<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\welcomeController;
use App\Http\Controllers\loginController;
//admin
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\ticketsController;
use App\Http\Controllers\admin\studentController;
use App\Http\Controllers\admin\subjectController;
use App\Http\Controllers\admin\teacherViewController;
use App\Http\Controllers\Admin\videoController;
use App\Http\Controllers\Admin\settingController;
//teacher
use App\Http\Controllers\Teacher\materialController;
use App\Http\Controllers\Teacher\TvideoController;
use App\Http\Controllers\Teacher\TeacherProfileController;
use Illuminate\Support\Facades\Session;
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

Route::get('/', [welcomeController::class ,'firstRun'])->name('welcome');

Route::get('/setLang/{lang}', function ($lang) {
    session(['locale' => $lang]);
    return back();
})->name('setLang');

Route::get('/logout', function () {
    Session::flush();
    return redirect()->route('welcome');
})->name('logout');

//login
Route::view('/login', 'login')->name('login');
Route::get('/login/{lange}', [loginController::class,'firstRun'])->name('home.login');
Route::post('/login/index', [loginController::class,'index'])->name('home.index');
Route::post('/login/create', [loginController::class,'create'])->name('home.create');

//teacher
Route::get('/material', [materialController::class,'index'])->name('teacher.material');
Route::get('/material/deleteunit/{id}', [materialController::class,'deleteUnit'])->name('teacher.material.delete.unit');
Route::get('/material/deletevideo/{id}', [materialController::class,'deleteVideo'])->name('teacher.material.delete.video');
Route::get('/material/material/{id}', [materialController::class,'deleteMaterial'])->name('teacher.material.delete.material');
Route::get('/material/createchapter', [materialController::class,'createChapter'])->name('teacher.material.createChapter');
Route::post('/material/addvideo', [materialController::class,'addvideo'])->name('teacher.material.addvideo');
Route::post('/material/addmaterial', [materialController::class,'addmaterial'])->name('teacher.material.addmaterial');

Route::get('/material/video/{id}', [TvideoController::class,'show'])->name('teacher.video');
Route::get('/material/video/comment/{id}', [TvideoController::class,'deleteComment'])->name('teacher.video.comment.delete');
Route::post('/material/video/block', [TvideoController::class,'blockuser'])->name('teacher.video.blockuser');
Route::post('/material/video/answer', [TvideoController::class,'addanswer'])->name('teacher.video.addanswer');
Route::get('/material/video/answer/delete/{id}', [TvideoController::class,'deleteAnswer'])->name('teacher.video.deleteAnswer');

Route::get('/teacher/profile', [TeacherProfileController::class, 'index'])->name('teacher.profile');
Route::post('/teacher/profile/update', [TeacherProfileController::class, 'updateProfile'])->name('teacher.updateProfile');
Route::post('/teacher/profile/update-image', [TeacherProfileController::class, 'updateProfileImage'])->name('teacher.updateImage');





//admin
Route::get('/dashboard', [dashboardController::class,'charts'])->name('admin.dashboard');

Route::get('/tickets', [ticketsController::class,'auth'])->name('admin.tickets');
Route::get('/tickets/index', [ticketsController::class,'index'])->name('admin.tickets.index');
Route::get('/tickets/{id}', [ticketsController::class,'update'])->name('admin.tickets.update');

Route::get('/studentView', [studentController::class,'auth'])->name('admin.studentView');
Route::get('/studentView/index', [studentController::class,'index'])->name('admin.studentView.index');
Route::get('/studentView/{id}', [studentController::class,'delete'])->name('admin.studentView.delete');
Route::get('/studentinfo/{id}', [studentController::class,'show'])->name('admin.studentinfo.show');

Route::get('/subjectView', [subjectController::class,'auth'])->name('admin.subjectView');
Route::get('/subjectView/index', [subjectController::class,'index'])->name('admin.subjectView.index');
Route::get('/subjectView/{Subjectid}', [subjectController::class,'subjectindex'])->name('admin.subjectView.subjectindex');
Route::get('/subjectView/{Subjectid}/{teacherid}', [subjectController::class,'subjectTeacherindex'])->name('admin.subjectView.subjectTeacherindex');

Route::get('/video/{id}', [videoController::class,'show'])->name('admin.video');
Route::get('/video/comment/{id}', [videoController::class,'deleteComment'])->name('admin.video.comment.delete');
Route::post('/video/block', [videoController::class,'blockuser'])->name('admin.video.blockuser');


Route::get('/teacherView', [teacherViewController::class,'auth'])->name('admin.teacherView');
Route::get('/teacherView/index', [teacherViewController::class,'index'])->name('admin.teacherView.index');
Route::post('/teacherView/filter', [teacherViewController::class,'filter'])->name('admin.teacherView.filter');
Route::post('/teacherView/store', [teacherViewController::class,'store'])->name('admin.teacherView.store');
Route::get('/teacherView/{id}', [teacherViewController::class,'show'])->name('admin.teacherView.show');
Route::get('/teacherView/delete/{id}', [teacherViewController::class,'delete'])->name('admin.teacherView.delete');

Route::get('/setting', [settingController::class,'index'])->name('admin.setting');
Route::get('/setting/deleteDepartment/{id}', [settingController::class,'deleteDepartment'])->name('admin.setting.deleteDepartment');
Route::get('/setting/deleteSubject/{id}', [settingController::class,'deleteSubject'])->name('admin.setting.deleteSubject');
Route::post('/setting/Department/store', [settingController::class,'storeDepartment'])->name('admin.setting.storeDepartment');
Route::post('/setting/Subject/store', [settingController::class,'storeSubject'])->name('admin.setting.storeSubject');
Route::get('/setting/blockremove/{id}', [settingController::class,'blockremove'])->name('admin.setting.blockremove');



