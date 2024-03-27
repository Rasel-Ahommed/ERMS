<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmpolyeeController;
use App\Http\Controllers\SiteUserController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\EmployeeReportController;
use App\Http\Controllers\ViewDailyreportController;

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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware('role:1')->group(function(){

        // manage user routes
        Route::get('/all-users', [SiteUserController::class, 'index'])->name('all-user');

        Route::post('/create-users', [SiteUserController::class, 'create'])->name('create-user');

        Route::post('/user-update', [SiteUserController::class, 'update'])->name('user-update');

        Route::get('/user-delete/{id}', [SiteUserController::class, 'destroy'])->name('user-delete');


        // daily-report route 
        Route::get('/daily-report', [DailyReportController::class, 'index'])->name('daily-report');

        Route::post('/get-employees/{team}', [DailyReportController::class, 'getEmployee'])->name('get-employees');

        Route::get('/view-report/{id}', [DailyReportController::class, 'showReport'])->name('view-report');

        Route::get('/view-daily-report', [ViewDailyreportController::class, 'index'])->name('view-daily-report');

        Route::get('/get-date-wise-report/{date}/{user_id}', [ViewDailyreportController::class, 'dateWiseReport'])->name('get-date-wise-report');


        // monthly-report route
        Route::get('/monthly-report', [MonthlyReportController::class, 'index'])->name('monthly-report');

        Route::get('/team-employees/{team}', [MonthlyReportController::class, 'getEmployee'])->name('team-employees');

        Route::post('/get-monthly-report', [MonthlyReportController::class, 'getMonthlyReport'])->name('get-monthly-report');

        Route::get('/month-daily-log/{log_id}', [MonthlyReportController::class, 'dailyLog'])->name('month-daily-log');

    });

    Route::middleware('role:2')->group(function(){
    //report routes
        Route::get('/my-report', [EmployeeReportController::class, 'index'])->name('my-report');

        Route::post('/day-start', [EmployeeReportController::class, 'startDay'])->name('day-start');

        Route::post('/create-log', [EmployeeReportController::class, 'storeLogs'])->name('create-log');

        Route::post('/day-end-report', [EmployeeReportController::class, 'dayEnd'])->name('day-end-report');

        Route::post('/update-log', [EmployeeReportController::class, 'update'])->name('update-log');

        Route::get('/delete-log/{id}', [EmployeeReportController::class, 'destroy'])->name('delete-log');
    });

});
