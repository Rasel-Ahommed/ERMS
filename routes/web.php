<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpolyeeController;
use App\Http\Controllers\SiteUserController;
use App\Http\Controllers\WorkTypeController;
use App\Http\Controllers\TodayPlanController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\EmployeeReportController;
use App\Http\Controllers\DailyPlanReportController;
use App\Http\Controllers\ViewDailyreportController;
use App\Http\Controllers\ViewMyMonthlyReportContrller;
use App\Http\Controllers\UserDailyPlanReportController;

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



       

        //daily plan report routes
        Route::get('daily-plan-report', [DailyPlanReportController::class, 'index'])->name('daily-plan-report');
        Route::post('get-daily-plan-report', [DailyPlanReportController::class, 'getReports'])->name('get-daily-plan-report');

        // daily-report route 
        Route::get('/daily-report', [DailyReportController::class, 'index'])->name('daily-report');

        Route::post('/get-employees/{team}', [DailyReportController::class, 'getEmployee'])->name('get-employees');

        Route::get('/view-report/{id}', [DailyReportController::class, 'showReport'])->name('view-report');

        Route::get('/view-daily-report', [ViewDailyreportController::class, 'index'])->name('view-daily-report');

        Route::get('/get-date-wise-report/{date}/{user_id}', [ViewDailyreportController::class, 'dateWiseReport'])->name('get-date-wise-report');

        Route::post('/store-work-type', [WorkTypeController::class, 'store'])->name('store.workType');


        // monthly-report route
        Route::get('/monthly-report', [MonthlyReportController::class, 'index'])->name('monthly-report');

        Route::get('/team-employees/{team}', [MonthlyReportController::class, 'getEmployee'])->name('team-employees');

        Route::post('/get-monthly-report', [MonthlyReportController::class, 'getMonthlyReport'])->name('get-monthly-report');

        

    });

    Route::middleware('role:2')->group(function(){
    //report routes
        Route::get('/my-report', [EmployeeReportController::class, 'index'])->name('my-report');

        Route::post('/day-start', [EmployeeReportController::class, 'startDay'])->name('day-start');

        Route::post('/create-log', [EmployeeReportController::class, 'storeLogs'])->name('create-log');

        Route::post('/day-end-report', [EmployeeReportController::class, 'dayEnd'])->name('day-end-report');

        Route::post('/update-log', [EmployeeReportController::class, 'update'])->name('update-log');

        Route::get('/delete-log/{id}', [EmployeeReportController::class, 'destroy'])->name('delete-log');



        // today plan route 
        Route::get('/today-plan', [TodayPlanController::class, 'index'])->name('today.plan');

        Route::post('/add-today-plan', [TodayPlanController::class, 'create'])->name('add.today.plan');
 
        Route::post('/update-today-plan', [TodayPlanController::class, 'update'])->name('update.today.plan');
 

        //daily plan report for user
        Route::get('my-task-list', [UserDailyPlanReportController::class, 'index'])->name('my-task-list');
        Route::post('get-my-plan-report', [UserDailyPlanReportController::class, 'getReports'])->name('get-my-plan-report');

        //view my monthly report for user
        Route::get('my-monthly-report', [ViewMyMonthlyReportContrller ::class, 'index'])->name('my-monthly-report');
        Route::post('get-my-monthly-report', [ViewMyMonthlyReportContrller ::class, 'getReports'])->name('get-my-monthly-report');

    
    
    

    // update user 
        Route::get('/user-profile', [ProfileController::class, 'index'])->name('user.profile');

        Route::post('/update-user', [ProfileController::class, 'update'])->name('update.user');

    // update password
        Route::post('/update.password', [ProfileController::class, 'changePassword'])->name('update.password');

    });


    // get daily report from under the monthly report. roll 1 and 2 both using this route
    Route::get('/month-daily-log/{log_id}', [MonthlyReportController::class, 'dailyLog'])->name('month-daily-log');
    
});
