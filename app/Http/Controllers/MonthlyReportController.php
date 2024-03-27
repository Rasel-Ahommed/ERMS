<?php

namespace App\Http\Controllers;

use App\Models\DailyReportDetails;
use App\Models\EmployeeReport;
use App\Models\Reports;
use App\Models\User;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller
{
    public function index(){
        return view('backoffice.monthlyReport.monthlyReport');
    }

    // get employee 
    public function getEmployee($team){
        $employees = User::where('team',$team)->get();
        return response()->json($employees);
    }

    // get monthly report 
    public function getMonthlyReport(Request $request){
        
        $request->validate([
            "start_date" => "required",
            "end_date" => "required",
            "team" => "required",
            "employee_id" => "required"
        ]);

        // dd($request->all());
        $reports = EmployeeReport::select('daily_report_logs.*', 'users.name as user_name', 'users.team as team')
                 ->join('users', 'daily_report_logs.user_id', '=', 'users.id')
                 ->where('date', '>=', $request->start_date)
                 ->where('date', '<=', $request->end_date)
                 ->where('user_id', $request->employee_id)
                 ->get();
        
        return redirect()->back()->with('reports', $reports);

        // return view('backoffice.monthlyReport.monthlyReport')->with(compact('reports'));
    }

    public function dailyLog($log_id){
        $daily_log = DailyReportDetails::select('daily_report_details.*', 'users.name as user_name', 'daily_report_logs.start_time as day_start_time', 'daily_report_logs.end_time as day_end_time', 'daily_report_logs.date as date')
                    ->join('users', 'daily_report_details.user_id', '=', 'users.id')
                    ->join('daily_report_logs', 'daily_report_details.daily_log_id', '=', 'daily_report_logs.id')
                    ->where('daily_log_id',$log_id)
                    ->get();

        return response()->json($daily_log);
    }
}
