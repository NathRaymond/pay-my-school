<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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

use App\Http\Controllers\AcademicSessionController;
use App\Http\Controllers\TermController;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('academic_session', AcademicSessionController::class);
        Route::get('activate_academic_session', [AcademicSessionController::class,'activate'])->name('activate_session');
        Route::resource('term', TermController::class);

        Route::group(['prefix' => 'student'], function () {
            Route::get('/', [App\Http\Controllers\StudentController::class, 'index'])->name('admin.student.index');
            Route::post('/create', [App\Http\Controllers\StudentController::class, 'create'])->name('admin.create.student');
            Route::get('/add/{id}', [App\Http\Controllers\StudentController::class, 'add'])->name('add.student.home');
            Route::get('/add', [App\Http\Controllers\StudentController::class, 'addNew'])->name('add_new_student_home');
            Route::get('/download', [App\Http\Controllers\StudentController::class, 'downloadExcel'])->name('download.student.excel');
            Route::post('/upload-student', [App\Http\Controllers\StudentController::class, 'upload'])->name('upload.student.record');
            Route::get('/edit-students/{id}', [App\Http\Controllers\StudentController::class, 'edit'])->name('edit.student');
            Route::post('/update-students/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('update.student');
            Route::post('/print', [App\Http\Controllers\StudentController::class, 'print'])->name('print.student');
            Route::get('/delete-students', [App\Http\Controllers\StudentController::class, 'delete'])->name('delete.student');
            Route::get('/view-details/{id}', [App\Http\Controllers\StudentController::class, 'details'])->name('view.student.details');
        });

        
    });
});
