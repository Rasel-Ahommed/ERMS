<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DailyReportController extends Controller
{
    public function index()
    {
        $datas = User::where('team', 'Business')->get();
        return view('backoffice.dailyReport.dailyReport', compact('datas'));
    }

    // get employee 
    public function getEmployee($team)
    {
        
        $datas = User::where('team', $team)->get();
        return response()->json($datas);
    }

    // show report 
    public function showReport($id)
    {
        $currentDate = Carbon::now()->format('Y-m-d');

        $daily_reports = Reports::where('report_table.date', $currentDate)
                        ->where('report_table.user_id', $id)
                        ->get();
                        
        session([
            'daily_reports' => $daily_reports,
            'user_id' => $id
        ]);

        // dd($daily_reports);
        return redirect()->route('view-daily-report');
    }
}
