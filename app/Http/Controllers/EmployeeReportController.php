<?php

namespace App\Http\Controllers;

use App\Models\DailyReportDetails;
use App\Models\EmployeeReport;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class EmployeeReportController extends Controller
{
    public function index()
    {
        $logs = EmployeeReport::join('daily_report_details', 'daily_report_logs.id', '=', 'daily_report_details.daily_log_id')
            ->where('daily_report_logs.user_id', auth()->user()->id) // Specify table name or alias for user_id column
            ->where('daily_report_logs.is_closed', 0)
            ->select(
                'daily_report_logs.*',
                'daily_report_details.start_time as start_time',
                'daily_report_details.end_time as end_time',
                'daily_report_details.work_title as work_title',
                'daily_report_details.work_details as work_details',
                'daily_report_details.id as id',
            )
            ->get();

        $daily_log = EmployeeReport::where('user_id', auth()->user()->id)
            ->where('is_closed', 0)
            ->first();

        return view('backoffice.employeeReport.employeeReport', compact('logs', 'daily_log'));
    }

    // day start 
    public function startDay(Request $request)
    {
        $request->validate([
            'start_time' => 'required'
        ]);

        //******validate empty log submit

        // Get the current date
        $currentDate = Carbon::now()->format('Y-m-d');
        $userId = auth()->id();

        $check_log = EmployeeReport::whereDate('date', $currentDate)
            ->where('user_id', $userId)
            ->exists();

        if ($check_log) {
            Session::flash('error', "Sorry, you've already submitted today's report.");
            return redirect()->back();
        }
        //***********/


        $data = [
            'user_id' => auth()->user()->id,
            'start_time' => $request->start_time,
            'date' => $currentDate
        ];

        EmployeeReport::create($data);

        return redirect()->back();
    }

    // store logs 
    public function storeLogs(Request $request)
    {
        $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
            'work_title' => 'required',
            'work_details' => 'required',
        ]);

        // *******validate existing time*******

        $user_id = auth()->user()->id;
        $log_id = $request->log_id;

        // Format start time and end time
        $start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('g:i A');
        $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('g:i A');

        // Check if either start time or end time exists
        $exists = DailyReportDetails::where('user_id', $user_id)
            ->where('daily_log_id', $log_id)
            ->where(function ($query) use ($request) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('start_time', '>=', $request->start_time)
                        ->where('start_time', '<', $request->end_time);
                })
                    ->orWhere(function ($subQuery) use ($request) {
                        $subQuery->where('end_time', '>', $request->start_time)
                            ->where('end_time', '<=', $request->end_time);
                    })
                    ->orWhere(function ($subQuery) use ($request) {
                        $subQuery->where('start_time', '<', $request->start_time)
                            ->where('end_time', '>', $request->end_time);
                    });
            })
            ->exists();

        if ($exists) {
            Session::flash('error', "Log already exists for the provided time range (Start Time: $start_time, End Time: $end_time)");
            return redirect()->back();
        }


        $data['user_id'] = $user_id;
        $data['daily_log_id'] = $log_id;
        $data['start_time'] = $request->start_time;
        $data['end_time'] = $request->end_time;
        $data['work_title'] = $request->work_title;
        $data['work_details'] = $request->work_details;

        DailyReportDetails::create($data);

        return redirect()->back()->with('success', 'Log created successfully');
    }

    // day end report
    public function dayEnd(Request $request)
    {
        if (empty($request->start_time)) {
            Session::flash('error', 'Please create report log');
            return redirect()->back();
        }

        $current_time = Carbon::now();

        $log_report = EmployeeReport::findOrFail($request->log_id);

        // dd($log_report);
        foreach ($request->start_time as $index => $value) {
            $data['user_id'] = auth()->user()->id;
            $data['daily_log_id'] = $request->log_id;
            $data['date'] = $request->date;
            $data['start_time'] = Carbon::parse($value)->format('H:i:s');
            $data['end_time'] = Carbon::parse($request->end_time[$index])->format('H:i:s');
            $data['work_title'] = $request->work_title[$index];
            $data['work_details'] = $request->work_details[$index];
            $data['day_start_time'] = $log_report->start_time;
            $data['day_end_time'] = $current_time;

            Reports::create($data);
        }

        $log_report->end_time = $current_time;

        $log_report->is_closed = 1;

        $log_report->update();

        return redirect()->back()->with('success', 'Day end successfully');
    }

    // update log 
    public function update(Request $request)
    {
        $data = DailyReportDetails::findOrFail($request->log_id);

        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->work_title = $request->work_title;
        $data->work_details = $request->work_details;

        $data->update();
        return redirect()->back()->with('success', 'Log Updated successfully');
    }


    // delete log 
    public function destroy($id)
    {

        $id = decrypt($id);

        $data = DailyReportDetails::findOrFail($id);

        $data->delete();

        return redirect()->back()->with('delete', 'Log deleted successfully');
    }
}
