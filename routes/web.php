<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/employee', function () {
        return Inertia::render('employee/Employee');
    })->name('employee');

    Route::get('/employee/add', function () {
        return Inertia::render('employee/AddEmployee');
    })->name('employee.add');

    Route::get('/employee/edit', function () {
        return Inertia::render('employee/EditEmployee', ['name' => 'Ariq', 'gender' => '1']);
    })->name('employee.edit');

    Route::get('/member', function () {
        return Inertia::render('member/Member');
    })->name('member');

    Route::get('/service', function () {
        return Inertia::render('service/Service');
    })->name('service');

    Route::get('/history', function () {
        return Inertia::render('history/History');
    })->name('history');

    Route::post('/test', function (Request $request) {
        return back();
    })->name('test');

    Route::delete('/delete', function (Request $request) {
        return redirect('/employee');
    })->name('delete');
});

require __DIR__ . '/auth.php';
