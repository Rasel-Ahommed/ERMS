<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeReport;

class ViewMyMonthlyReportContrller extends Controller
{
    public function index(){
        return view('backoffice.viewMyMonthlyReport.viewMyMonthlyReport');
    }

    // get monthly report 
    public function getReports(Request $request){
        
        $request->validate([
            "start_date" => "required",
            "end_date" => "required"
        ]);

        // dd($request->all());
        $my_monthly_reports = EmployeeReport::select('daily_report_logs.*', 'users.name as user_name', 'users.team as team')
                 ->join('users', 'daily_report_logs.user_id', '=', 'users.id')
                 ->where('date', '>=', $request->start_date)
                 ->where('date', '<=', $request->end_date)
                 ->where('user_id', auth()->user()->id)
                 ->get();


        if(!$my_monthly_reports->isEmpty()){
            session([
                'user_name' => $my_monthly_reports[0]->user_name,
            ]);
        }

        return redirect()->back()->with('my_monthly_reports', $my_monthly_reports);

    }
}
