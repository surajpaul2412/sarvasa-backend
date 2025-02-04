<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GoldRateController;
use App\Http\Controllers\Admin\EnquiryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// Redirects
Route::redirect('/', '/login');

// Admin Routes
Route::middleware(['auth'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // gold rate
    Route::get('/admin/gold-rates', [GoldRateController::class, 'index'])->name('goldRate.index');
    Route::post('/admin/gold-rates', [GoldRateController::class, 'store'])->name('goldRate.store');
    Route::get('/admin/gold-rates/{id}/edit', [GoldRateController::class, 'edit'])->name('goldRate.edit');
    Route::put('/admin/gold-rates/{id}', [GoldRateController::class, 'update'])->name('goldRate.update');
    Route::delete('/admin/gold-rates/{id}', [GoldRateController::class, 'destroy'])->name('goldRate.destroy');

    // Enquiry
    Route::get('/admin/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index'); // List enquiries
    Route::get('/admin/enquiries/create', [EnquiryController::class, 'create'])->name('enquiries.create'); // Show create form
    Route::post('/admin/enquiries', [EnquiryController::class, 'store'])->name('enquiries.store'); // Store enquiry
    Route::get('/admin/enquiries/{id}/edit', [EnquiryController::class, 'edit'])->name('enquiries.edit'); // Show edit form
    Route::put('/admin/enquiries/{id}', [EnquiryController::class, 'update'])->name('enquiries.update'); // Update enquiry
    Route::delete('/admin/enquiries/{id}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy'); // Delete enquiry

    Route::post('/admin/enquiries/update-stage', [EnquiryController::class, 'updateStage'])->name('enquiries.updateStage');
});
