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
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SchoolFeeController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\ClassesController;

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

        Route::group(['prefix' => 'payment'], function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('admin.payment-report');
            Route::get('/invoices', [InvoiceController::class, 'index'])->name('admin.invoices');
            Route::get('/invoice-breakdown', [InvoiceController::class, 'show'])->name('admin.invoice-breakdown');
            Route::get('/school-fees', [SchoolFeeController::class, 'index'])->name('admin.school-fees');
            Route::get('/download-school-fee-template', [SchoolFeeController::class, 'downloadExcel'])->name('download-school-fee-template');
            Route::post('/upload-school-fees', [SchoolFeeController::class, 'uploadSchoolFee'])->name('upload-school-fee');

        });

        // class module
        Route::group(['prefix' => 'classes'], function () {
            Route::get('/', [ClassesController::class, 'index'])->name('admin.class.index');
            Route::post('/create', [ClassesController::class, 'create'])->name('admin.create.class');
            Route::get('/get-sub-classes', [ClassesController::class, 'getSubClasses'])->name('get.sub.classes');
        });
        //  subclass module
        Route::group(['prefix' => 'sub-classes'], function () {
            Route::get('/', [ClassesController::class, 'subClassIndex'])->name('admin.subclass.index');
            Route::post('/create', [ClassesController::class, 'createSubClass'])->name('admin.create.sub.class');
        });

    });
});
