<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ActiveStudentLetterController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomingLetterCategoryController;
use App\Http\Controllers\IncomingLetterController;
use App\Http\Controllers\IncomingLetterDispositionController;
use App\Http\Controllers\LeavePermitLetterController;
use App\Http\Controllers\My\LeavePermitLetterController as MyLeavePermitLetterController;
use App\Http\Controllers\My\SppdLetterController as MySppdLetterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\Report\ActiveStudentLetterController as ReportActiveStudentLetterController;
use App\Http\Controllers\Report\IncomingLetterController as ReportIncomingLetterController;
use App\Http\Controllers\Report\IncomingLetterDispositionController as ReportIncomingLetterDispositionController;
use App\Http\Controllers\Report\LeavePermitLetterController as ReportLeavePermitLetterController;
use App\Http\Controllers\Report\LetterStatistic;
use App\Http\Controllers\Report\SchoolDocumentController as ReportSchoolDocumentController;
use App\Http\Controllers\Report\SchoolTransferLetterController as ReportSchoolTransferLetterController;
use App\Http\Controllers\Report\SppdLetterController as ReportSppdLetterController;
use App\Http\Controllers\Report\StudentCertificateController as ReportStudentCertificateController;
use App\Http\Controllers\SchoolDocumentController;
use App\Http\Controllers\SchoolTransferLetterController;
use App\Http\Controllers\PindahProdiController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\SppdLetterController;
use App\Http\Controllers\StudentCertificateController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\Student;
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

Route::get('/login', [LoginController::class, 'index'])->middleware(['guest'])->name('login.index');
Route::post('/login', [LoginController::class, 'attempt'])->middleware(['guest'])->name('login.attempt');
Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->middleware(['guest'])->name('register.index');
Route::post('/register', [RegisterController::class, 'attempt'])->middleware(['guest'])->name('register.attempt');

Route::get('/forgot-password', [PasswordResetController::class, 'request'])->middleware(['guest'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'email'])->middleware(['guest'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset'])->middleware(['guest'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'update'])->middleware(['guest'])->name('password.update');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home.index');
    }
    return view('home.guest');
});

Route::get('/signature/check/{signature}', [SignatureController::class, 'check'])->name('signature.check');
Route::get('/signature/by/{user}', [SignatureController::class, 'by'])->name('signature.by');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/home/chart', [HomeController::class, 'chart'])->name('home.chart');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notification.index');

    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');
    Route::post('/account/change-password', [AccountController::class, 'changePassword'])->name('account.change-password');
    Route::put('/account/change-role', [AccountController::class, 'changeRole'])->name('account.change-role');
    Route::put('/account/change-avatar', [AccountController::class, 'changeAvatar'])->name('account.change-avatar');
    Route::delete('/account/delete-avatar', [AccountController::class, 'deleteAvatar'])->name('account.delete-avatar');

    Route::get('/positions', [PositionController::class, 'index'])->name('position.index');
    Route::post('/positions', [PositionController::class, 'store'])->name('position.store');
    Route::put('/positions/{position}', [PositionController::class, 'update'])->name('position.update');
    Route::delete('/positions/{position}', [PositionController::class, 'destroy'])->name('position.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('user.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::put('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('user.reset-password');
    Route::put('/users/{user}/change-avatar', [UserController::class, 'changeAvatar'])->name('user.change-avatar');

    Route::get('/incoming-letter-categories', [IncomingLetterCategoryController::class, 'index'])->name('incoming-letter-category.index');
    Route::post('/incoming-letter-categories', [IncomingLetterCategoryController::class, 'store'])->name('incoming-letter-category.store');
    Route::put('/incoming-letter-categories/{incomingLetterCategory}', [IncomingLetterCategoryController::class, 'update'])->name('incoming-letter-category.update');
    Route::delete('/incoming-letter-categories/{incomingLetterCategory}', [IncomingLetterCategoryController::class, 'destroy'])->name('incoming-letter-category.destroy');

    Route::get('/incoming-letters', [IncomingLetterController::class, 'index'])->name('incoming-letter.index');
    Route::get('/incoming-letters/create', [IncomingLetterController::class, 'create'])->name('incoming-letter.create');
    Route::post('/incoming-letters', [IncomingLetterController::class, 'store'])->name('incoming-letter.store');
    Route::get('/incoming-letters/{incomingLetter}', [IncomingLetterController::class, 'show'])->name('incoming-letter.show');
    Route::get('/incoming-letters/{incomingLetter}/edit', [IncomingLetterController::class, 'edit'])->name('incoming-letter.edit');
    Route::put('/incoming-letters/{incomingLetter}', [IncomingLetterController::class, 'update'])->name('incoming-letter.update');
    Route::delete('/incoming-letters/{incomingLetter}', [IncomingLetterController::class, 'destroy'])->name('incoming-letter.destroy');

    Route::get('/incoming-letter-dispositions', [IncomingLetterDispositionController::class, 'index'])->name('incoming-letter-disposition.index');
    Route::get('/incoming-letter-dispositions/create', [IncomingLetterDispositionController::class, 'create'])->name('incoming-letter-disposition.create');
    Route::post('/incoming-letter-dispositions', [IncomingLetterDispositionController::class, 'store'])->name('incoming-letter-disposition.store');
    Route::get('/incoming-letter-dispositions/{incomingLetterDisposition}', [IncomingLetterDispositionController::class, 'show'])->name('incoming-letter-disposition.show');
    Route::get('/incoming-letter-dispositions/{incomingLetterDisposition}/edit', [IncomingLetterDispositionController::class, 'edit'])->name('incoming-letter-disposition.edit');
    Route::put('/incoming-letter-dispositions/{incomingLetterDisposition}', [IncomingLetterDispositionController::class, 'update'])->name('incoming-letter-disposition.update');
    Route::delete('/incoming-letter-dispositions/{incomingLetterDisposition}', [IncomingLetterDispositionController::class, 'destroy'])->name('incoming-letter-disposition.destroy');
    Route::get('/incoming-letter-dispositions/{incomingLetterDisposition}/print', [IncomingLetterDispositionController::class, 'print'])->name('incoming-letter-disposition.print');

    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/students', [StudentController::class, 'store'])->name('student.store');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('student.destroy');

    Route::get('/active-student-letters', [ActiveStudentLetterController::class, 'index'])->name('active-student-letter.index');
    Route::get('/active-student-letters/create', [ActiveStudentLetterController::class, 'create'])->name('active-student-letter.create');
    Route::post('/active-student-letters', [ActiveStudentLetterController::class, 'store'])->name('active-student-letter.store');
    Route::get('/active-student-letters/{activeStudentLetter}', [ActiveStudentLetterController::class, 'show'])->name('active-student-letter.show');
    Route::get('/active-student-letters/{activeStudentLetter}/edit', [ActiveStudentLetterController::class, 'edit'])->name('active-student-letter.edit');
    Route::put('/active-student-letters/{activeStudentLetter}', [ActiveStudentLetterController::class, 'update'])->name('active-student-letter.update');
    Route::delete('/active-student-letters/{activeStudentLetter}', [ActiveStudentLetterController::class, 'destroy'])->name('active-student-letter.destroy');
    Route::put('/active-student-letters/{activeStudentLetter}/verify', [ActiveStudentLetterController::class, 'verify'])->name('active-student-letter.verify');
    Route::put('/active-student-letters/{activeStudentLetter}/reject', [ActiveStudentLetterController::class, 'reject'])->name('active-student-letter.reject');
    Route::get('/active-student-letters/{activeStudentLetter}/print', [ActiveStudentLetterController::class, 'print'])->name('active-student-letter.print');

    Route::get('/student-certificates', [StudentCertificateController::class, 'index'])->name('student-certificate.index');
    Route::get('/student-certificates/create', [StudentCertificateController::class, 'create'])->name('student-certificate.create');
    Route::post('/student-certificates', [StudentCertificateController::class, 'store'])->name('student-certificate.store');
    Route::get('/student-certificates/{studentCertificate}', [StudentCertificateController::class, 'show'])->name('student-certificate.show');
    Route::get('/student-certificates/{studentCertificate}/edit', [StudentCertificateController::class, 'edit'])->name('student-certificate.edit');
    Route::put('/student-certificates/{studentCertificate}', [StudentCertificateController::class, 'update'])->name('student-certificate.update');
    Route::delete('/student-certificates/{studentCertificate}', [StudentCertificateController::class, 'destroy'])->name('student-certificate.destroy');

    Route::get('/school-documents', [SchoolDocumentController::class, 'index'])->name('school-document.index');
    Route::get('/school-documents/create', [SchoolDocumentController::class, 'create'])->name('school-document.create');
    Route::post('/school-documents', [SchoolDocumentController::class, 'store'])->name('school-document.store');
    Route::get('/school-documents/{schoolDocument}', [SchoolDocumentController::class, 'show'])->name('school-document.show');
    Route::get('/school-documents/{schoolDocument}/edit', [SchoolDocumentController::class, 'edit'])->name('school-document.edit');
    Route::put('/school-documents/{schoolDocument}', [SchoolDocumentController::class, 'update'])->name('school-document.update');
    Route::delete('/school-documents/{schoolDocument}', [SchoolDocumentController::class, 'destroy'])->name('school-document.destroy');

    Route::get('/school-transfer-letters', [SchoolTransferLetterController::class, 'index'])->name('school-transfer-letter.index');
    Route::get('/school-transfer-letters/create', [SchoolTransferLetterController::class, 'create'])->name('school-transfer-letter.create');
    Route::post('/school-transfer-letters', [SchoolTransferLetterController::class, 'store'])->name('school-transfer-letter.store');
    Route::get('/school-transfer-letters/{schoolTransferLetter}', [SchoolTransferLetterController::class, 'show'])->name('school-transfer-letter.show');
    Route::get('/school-transfer-letters/{schoolTransferLetter}/edit', [SchoolTransferLetterController::class, 'edit'])->name('school-transfer-letter.edit');
    Route::put('/school-transfer-letters/{schoolTransferLetter}', [SchoolTransferLetterController::class, 'update'])->name('school-transfer-letter.update');
    Route::delete('/school-transfer-letters/{schoolTransferLetter}', [SchoolTransferLetterController::class, 'destroy'])->name('school-transfer-letter.destroy');
    Route::put('/school-transfer-letters/{schoolTransferLetter}/verify', [SchoolTransferLetterController::class, 'verify'])->name('school-transfer-letter.verify');
    Route::put('/school-transfer-letters/{schoolTransferLetter}/reject', [SchoolTransferLetterController::class, 'reject'])->name('school-transfer-letter.reject');
    Route::get('/school-transfer-letters/{schoolTransferLetter}/print', [SchoolTransferLetterController::class, 'print'])->name('school-transfer-letter.print');

    Route::get('/pindah-prodi', [PindahProdiController::class, 'index'])->name('pindah-prodi.index');
    Route::get('/pindah-prodi/create', [PindahProdi::class, 'create'])->name('pindah-prodi.create');
    Route::post('/pindah-prodi', [PindahProdi::class, 'store'])->name('pindah-prodi.store');
    Route::get('/pindah-prodi/{PindahProdi}', [PindahProdi::class, 'show'])->name('pindah-prodi.show');
    Route::get('/pindah-prodi/{PindahProdi}/edit', [PindahProdi::class, 'edit'])->name('pindah-prodi.edit');
    Route::put('/pindah-prodi/{PindahProdi}', [PindahProdi::class, 'update'])->name('pindah-prodi.update');
    Route::delete('/pindah-prodi/{PindahProdi}', [PindahProdi::class, 'destroy'])->name('pindah-prodi.destroy');
    Route::put('/pindah-prodi/{PindahProdi}/verify', [PindahProdi::class, 'verify'])->name('pindah-prodi.verify');
    Route::put('/pindah-prodi/{PindahProdi}/reject', [PindahProdi::class, 'reject'])->name('pindah-prodi.reject');
    Route::get('/pindah-prodi/{PindahProdi}/print', [PindahProdi::class, 'print'])->name('pindah-prodi.print');

    Route::get('/sppd-letters', [SppdLetterController::class, 'index'])->name('sppd-letter.index');
    Route::get('/sppd-letters/create', [SppdLetterController::class, 'create'])->name('sppd-letter.create');
    Route::post('/sppd-letters', [SppdLetterController::class, 'store'])->name('sppd-letter.store');
    Route::get('/sppd-letters/{sppdLetter}', [SppdLetterController::class, 'show'])->name('sppd-letter.show');
    Route::get('/sppd-letters/{sppdLetter}/edit', [SppdLetterController::class, 'edit'])->name('sppd-letter.edit');
    Route::put('/sppd-letters/{sppdLetter}', [SppdLetterController::class, 'update'])->name('sppd-letter.update');
    Route::delete('/sppd-letters/{sppdLetter}', [SppdLetterController::class, 'destroy'])->name('sppd-letter.destroy');
    Route::put('/sppd-letters/{sppdLetter}/verify', [SppdLetterController::class, 'verify'])->name('sppd-letter.verify');
    Route::put('/sppd-letters/{sppdLetter}/reject', [SppdLetterController::class, 'reject'])->name('sppd-letter.reject');
    Route::get('/sppd-letters/{sppdLetter}/print', [SppdLetterController::class, 'print'])->name('sppd-letter.print');

    Route::get('/leave-permit-letters', [LeavePermitLetterController::class, 'index'])->name('leave-permit-letter.index');
    Route::get('/leave-permit-letters/create', [LeavePermitLetterController::class, 'create'])->name('leave-permit-letter.create');
    Route::post('/leave-permit-letters', [LeavePermitLetterController::class, 'store'])->name('leave-permit-letter.store');
    Route::get('/leave-permit-letters/{leavePermitLetter}', [LeavePermitLetterController::class, 'show'])->name('leave-permit-letter.show');
    Route::get('/leave-permit-letters/{leavePermitLetter}/edit', [LeavePermitLetterController::class, 'edit'])->name('leave-permit-letter.edit');
    Route::put('/leave-permit-letters/{leavePermitLetter}', [LeavePermitLetterController::class, 'update'])->name('leave-permit-letter.update');
    Route::delete('/leave-permit-letters/{leavePermitLetter}', [LeavePermitLetterController::class, 'destroy'])->name('leave-permit-letter.destroy');
    Route::put('/leave-permit-letters/{leavePermitLetter}/verify', [LeavePermitLetterController::class, 'verify'])->name('leave-permit-letter.verify');
    Route::put('/leave-permit-letters/{leavePermitLetter}/reject', [LeavePermitLetterController::class, 'reject'])->name('leave-permit-letter.reject');
    Route::get('/leave-permit-letters/{leavePermitLetter}/print', [LeavePermitLetterController::class, 'print'])->name('leave-permit-letter.print');

    Route::get('/my-leave-permit-letter', [MyLeavePermitLetterController::class, 'index'])->name('my.leave-permit-letter.index');
    Route::get('/my-leave-permit-letter/{leavePermitLetter}/print', [MyLeavePermitLetterController::class, 'print'])->name('my.leave-permit-letter.print');

    Route::get('/my-sppd-letter', [MySppdLetterController::class, 'index'])->name('my.sppd-letter.index');
    Route::get('/my-sppd-letter/{sppdLetter}', [MySppdLetterController::class, 'print'])->name('my.sppd-letter.print');

    Route::get('/report-incoming-letter', [ReportIncomingLetterController::class, 'index'])->name('report.incoming-letter.index');
    Route::get('/report-incoming-letter/print', [ReportIncomingLetterController::class, 'print'])->name('report.incoming-letter.print');

    Route::get('/report-incoming-letter-disposition/print', [ReportIncomingLetterDispositionController::class, 'print'])->name('report.incoming-letter-disposition.print');
    Route::get('/report-incoming-letter-disposition', [ReportIncomingLetterDispositionController::class, 'index'])->name('report.incoming-letter-disposition.index');

    Route::get('/report-active-student-letter/print', [ReportActiveStudentLetterController::class, 'print'])->name('report.active-student-letter.print');
    Route::get('/report-active-student-letter', [ReportActiveStudentLetterController::class, 'index'])->name('report.active-student-letter.index');

    Route::get('/report-school-transfer-letter/print', [ReportSchoolTransferLetterController::class, 'print'])->name('report.school-transfer-letter.print');
    Route::get('/report-school-transfer-letter', [ReportSchoolTransferLetterController::class, 'index'])->name('report.school-transfer-letter.index');

    Route::get('/report-sppd-letter/print', [ReportSppdLetterController::class, 'print'])->name('report.sppd-letter.print');
    Route::get('/report-sppd-letter', [ReportSppdLetterController::class, 'index'])->name('report.sppd-letter.index');

    Route::get('/report-leave-permit-letter/print', [ReportLeavePermitLetterController::class, 'print'])->name('report.leave-permit-letter.print');
    Route::get('/report-leave-permit-letter', [ReportLeavePermitLetterController::class, 'index'])->name('report.leave-permit-letter.index');

    Route::get('/report-school-document/print', [ReportSchoolDocumentController::class, 'print'])->name('report.school-document.print');
    Route::get('/report-school-document', [ReportSchoolDocumentController::class, 'index'])->name('report.school-document.index');

    Route::get('/report-student-certificate/print', [ReportStudentCertificateController::class, 'print'])->name('report.student-certificate.print');
    Route::get('/report-student-certificate', [ReportStudentCertificateController::class, 'index'])->name('report.student-certificate.index');

    Route::get('/system/activities', [ActivityController::class, 'index'])->name('system.activities');
    Route::delete('/system/activities', [ActivityController::class, 'clear'])->name('system.activities.clear');
});
