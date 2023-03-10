<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\DebtController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/debts', function () {
        return Inertia::render('Debts/Show');
    })->name('show');

    Route::get('/import', function () {
        return Inertia::render('ImportFile');
    })->name('import');

    Route::get('/debts', [DebtController::class, 'show'])->name('show');

    Route::post('/upload', [DebtController::class, 'upload'])->name('upload');

    Route::post('/tickets', [DebtController::class, 'generateTickets'])->name('tickets');
});
