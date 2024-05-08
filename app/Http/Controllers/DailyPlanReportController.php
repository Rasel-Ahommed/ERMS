<?php

namespace App\Http\Controllers;

use App\Models\TodayPlan;
use Illuminate\Http\Request;

class DailyPlanReportController extends Controller
{
    public function index(){
        return view('backoffice.dailyPlanReport.dailyPlanReport');
    }

    public function getReports(Request $request){
        $request->validate([
            "start_date" => "required",
            "end_date" => "required",
            "team" => "required",
            "employee_id" => "required"
        ]);

        // dd($request->all());
        $plan_reports = TodayPlan::select('today_plans.*', 'users.name as user_name', 'users.team as team')
                 ->join('users', 'today_plans.user_id', '=', 'users.id')
                 ->where('date', '>=', $request->start_date)
                 ->where('date', '<=', $request->end_date)
                 ->where('user_id', $request->employee_id)
                 ->get();

        return redirect()->back()->with('plan_reports', $plan_reports);
    }
}
