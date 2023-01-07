<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberTypeController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ServiceController;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
    ]);
});

Route::middleware(['auth', 'verified', 'isActive'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('', 'index')->name('dashboard');
            Route::get('add-order', 'addOrder')->name('dashboard.order');
            Route::post('add-order/create', 'addOrderStore')->name('order.create');
            Route::post('finish-order', 'finishOrder')->name('order.finish');
        });
    });

    Route::middleware(['isAdmin'])->group(function () {
        Route::prefix("employee")->group(function () {
            Route::controller(EmployeeController::class)->group(function () {
                Route::get('', 'index')->name('employee.index');
                Route::get('create', 'create')->name('employee.create');
                Route::post('store', 'store')->name('employee.store');
                Route::get('edit/{id}', 'edit')->name('employee.edit');
                Route::post('update/{id}', 'update')->name('employee.update');
                Route::post('deactivate', 'deactivate')->name('employee.deactivate');
            });
        });
    });

    Route::prefix("member")->group(function () {
        Route::controller(MemberController::class)->group(function () {
            Route::get('', 'index')->name('member.index');
            Route::get('create', 'create')->name('member.create');
            Route::post('store', 'store')->name('member.store');
            Route::get('edit/{id}', 'edit')->name('member.edit');
            Route::post('update/{id}', 'update')->name('member.update');
        });

        Route::controller(MemberTypeController::class)->group(function () {
            Route::post('type/update/{id}', 'update')->name('member.updateType');
        });
    });

    Route::prefix("service")->group(function () {
        Route::controller(ServiceController::class)->group(function () {
            Route::get('', 'index')->name('service.index');
            Route::post('store', 'store')->middleware('isAdmin')->name('service.store');
            Route::post('update', 'update')->middleware('isAdmin')->name('service.update');
        });
    });

    Route::prefix('history')->group(function () {
        Route::controller(HistoryController::class)->group(function () {
            Route::get('', 'index')->name('history');
            Route::get('order-info/{id}', 'show')->name('history.info');
        });
    });

    Route::prefix('print')->group(function () {
        Route::controller(PrintController::class)->group(function () {
            Route::get('invoice/{id}', 'printInvoice')->name('print.invoice');
        });
    });

    // Route::get('/add-order', function () {
    //     return Inertia::render('AddOrder');
    // })->name('addOrder');

    // Route::get('/employee/add', function () {
    //     return Inertia::render('employee/AddEmployee');
    // })->name('employee.add');

    // Route::get('/employee/edit/{id}', function () {
    //     return Inertia::render('employee/EditEmployee', ['name' => 'Ariq', 'gender' => '1']);
    // })->name('employee.edit');

    // Route::get('/member', function () {
    //     return Inertia::render('member/Member');
    // })->name('member');


    // Route::get('/member/add', function () {
    //     return Inertia::render('member/AddMember');
    // })->name('member.add');

    // Route::get('/member/edit/{id}', function () {
    //     return Inertia::render('member/EditMember', ['name' => 'Daisuke']);
    // })->name('member.edit');

    // Route::get('/service', function () {
    //     return Inertia::render('service/Service');
    // })->name('service');

    // Route::get('/history', function () {
    //     return Inertia::render('history/History');
    // })->name('history');

    // Route::delete('/delete', function (Request $request) {
    //     return redirect('/employee');
    // })->name('delete');
});

require __DIR__ . '/auth.php';
