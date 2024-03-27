<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reports;
use Illuminate\Http\Request;

class ViewDailyreportController extends Controller
{
    public function index()
    {
        $daily_reports = session('daily_reports');

        $user_id = session('user_id');

        $user = User::where('id',$user_id)->first();

        return view('backoffice.dailyReport.viewDailyReport', compact('daily_reports','user'));
    }

    // date wise report 

    public function dateWiseReport($date, $user_id){
        
        $daily_reports = Reports::where('date', $date)
                        ->where('user_id', $user_id)
                        ->get();
                return response()->json($daily_reports);
    }
}
