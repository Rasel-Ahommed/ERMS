<?php

namespace App\Http\Controllers;

use App\Models\TodayPlan;
use Illuminate\Http\Request;

class UserDailyPlanReportController extends Controller
{
    public function index(){
        return view('backoffice.myTaskList.myTaskList');
    }

    public function getReports(Request $request){
        $request->validate([
            "start_date" => "required",
            "end_date" => "required"
        ]);

        // dd($request->all());
        $my_plan_reports = TodayPlan::select('today_plans.*', 'users.name as user_name', 'users.team as team')
                 ->join('users', 'today_plans.user_id', '=', 'users.id')
                 ->where('date', '>=', $request->start_date)
                 ->where('date', '<=', $request->end_date)
                 ->where('user_id', auth()->user()->id)
                 ->get();

        return redirect()->back()->with('my_plan_reports', $my_plan_reports);
    }
}
