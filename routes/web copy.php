<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\user;
use App\Models\Invoice;
use App\Models\InvoiceBreakdown;
use App\Models\AcademicSession;
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
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ClassesController;

Auth::routes();

// Route::get('/register', [SchoolController::class, 'schoolRegister'])->name('school.registration');
// Route::post('/payment', [SchoolController::class, 'storePayment'])->name('store.payment');
// Route::post('/payment/verify', [SchoolController::class, 'verifyPayment'])->name('verify.payment');
// Route::post('/payment/callback', [SchoolController::class, 'handleCallback'])->name('payment.callback');

Route::get('/register', [SchoolController::class, 'showForm'])->name('register.form');
Route::post('/payment/verify', [SchoolController::class, 'verifyPayment'])->name('payment.verify');

Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback'])->name('payment');

Route::get('/success', function () {
    return view('components.success');
})->name('success');

Route::get('/failure', function () {
    return view('components.failure');
})->name('failure');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        $data['user'] = Auth::user();
        $data['totalstudent'] = Student::count();
        $data['currentsession'] = AcademicSession::where('active', true)->first();

        $data['currentTermIncome'] = 0;
        $data['currentSessionIncome'] = 0;
        $data['currentTermOutstanding'] = 0;

        if ($data['currentsession']) {
            $data['currentTermInvoices'] = Invoice::where('term_id', $data['currentsession']->current_term_id);
            $data['currentTermIncome'] = Invoice::where('term_id', $data['currentsession']->current_term_id)->sum('total_amount');
            $data['currentTermIncome'] = Invoice::where('term_id', $data['currentsession']->id)->sum('total_amount');

            // Calculate outstanding amount for the current term
            //  $data['totalAmount'] = $data['currentTermInvoices']->sum('total_amount');
            //  $data['paidAmount'] = $data['currentTermInvoices']->sum('paid_amount');
            //  $data['currentTermOutstanding'] = $totalAmount - $paidAmount;


            // Calculate outstanding amount for the current term
            $data['currentTermOutstanding'] = InvoiceBreakdown::where('term_id', $data['currentsession']->current_term_id)->where('payment_status', 'unpaid')->sum('payment_status');
        }
        return view('welcome', $data);
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::resource('academic_session', AcademicSessionController::class);
        Route::get('activate_academic_session', [AcademicSessionController::class, 'activate'])->name('activate_session');
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