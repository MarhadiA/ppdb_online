<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentDocumentController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPanitiaController;
use App\Http\Controllers\AdminSeleksiController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JalurPendaftaranController;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index']);
Route::get('/cek-status', [HomeController::class, 'checkStatus']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);


// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });

// Route::get('/panitia/dashboard', function () {
//     return view('panitia.dashboard');
// });
Route::middleware(['auth', 'role:admin'])->group(function () {

     // DASHBOARD
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
        // SELEKSI
    Route::get('/admin/seleksi', [AdminSeleksiController::class, 'index']);
    Route::post('/admin/seleksi/run', [AdminSeleksiController::class, 'run']);
    Route::get('/admin/seleksi/preview', [AdminSeleksiController::class, 'preview']);

       // LAPORAN
   Route::get('/admin/export/seleksi', [ExportController::class, 'exportLolos']);

        // PENGUMUMAN
    Route::get('/admin/announcements', [AnnouncementController::class, 'index']);
    Route::post('/admin/announcements', [AnnouncementController::class, 'store']);
    Route::put('/admin/announcements/{id}', [AnnouncementController::class, 'update']);
    Route::delete('/admin/announcements/{id}', [AnnouncementController::class, 'destroy']);
    //Jalur
    Route::get('/admin/jalur', [JalurPendaftaranController::class, 'index']);
    Route::post('/admin/jalur', [JalurPendaftaranController::class, 'store']);
    Route::put('/admin/jalur/{id}', [JalurPendaftaranController::class, 'update']);
    Route::delete('/admin/jalur/{id}', [JalurPendaftaranController::class, 'destroy']);

    Route::post('/admin/announcements/{id}/toggle', [AnnouncementController::class, 'toggle']);

    Route::get('/admin/panitia', [AdminPanitiaController::class, 'index']);
    Route::post('/admin/panitia', [AdminPanitiaController::class, 'store']);
    Route::delete('/admin/panitia/{id}', [AdminPanitiaController::class, 'destroy']);
});

// Route::get('/student/dashboard', function () {
//     return view('student.dashboard');
// });

// Route::get('/student/registration/create', function () {
//     return view('student.registration.create');
// });

// Route::get(
//     '/student/registration/create',
//     [StudentRegistrationController::class, 'create']
// );

// Route::post(
//     '/student/registration/store',
//     [StudentRegistrationController::class, 'store']
// );

// Route::middleware(['auth', 'role:student'])->group(function () {

//     Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
//         ->name('student.dashboard');

//     Route::get('/student/documents', [StudentDocumentController::class, 'index'])
//         ->name('student.documents');

//     Route::post('/student/documents', [StudentDocumentController::class, 'store'])
//         ->name('student.documents.store');
// });
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/registration/create', [StudentRegistrationController::class, 'create'])
            ->name('registration.create');

        Route::post('/registration/store', [StudentRegistrationController::class, 'store'])
            ->name('registration.store');

        Route::get('/documents', [StudentDocumentController::class, 'index'])
            ->name('documents');

        Route::post('/documents', [StudentDocumentController::class, 'store'])
            ->name('documents.store');
    });

Route::middleware(['auth', 'role:panitia'])->group(function () {

    Route::get('/panitia/dashboard', [PanitiaController::class, 'dashboard']);
    Route::get('/panitia/registrations', [PanitiaController::class, 'index']);
    Route::get('/panitia/registrations/{id}', [PanitiaController::class, 'show']);
        // VERIFIKASI
    Route::post('/panitia/document/{id}/approve', [PanitiaController::class, 'approve']);
    Route::post('/panitia/document/{id}/reject', [PanitiaController::class, 'reject']);
});