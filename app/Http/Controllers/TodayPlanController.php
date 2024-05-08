<?php

namespace App\Http\Controllers;

use App\Models\TodayPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TodayPlanController extends Controller
{
    public function index(){
        $current_date = Carbon::now()->format('Y-m-d');
        $user_id = auth()->user()->id;

        $plans = TodayPlan::where('user_id',$user_id)
                 ->where('date',$current_date)
                 ->first();
        
        return view('backoffice.dailyTask.dailyTask',compact('plans'));
    }

    // create plan 

    public function create(Request $request){
        $request->validate([
            'today_plan' => 'required'
        ]);
        
        $current_date = Carbon::now();

        $data['plan_dtls'] = $request->today_plan;
        $data['date'] = $current_date;
        $data['user_id'] = auth()->user()->id;

        TodayPlan::create($data);

        return redirect()->back()->with('success', 'Plan added successfully');
    }


    public function update(Request $request){
        $request->validate([
            'update_plan' => 'required'
        ]);
        
        $data = TodayPlan::findOrFail($request->id);
        

        $data->plan_dtls = $request->update_plan;

        $data->save();

        return redirect()->back()->with('success', 'Plan Updated successfully');
    }
}
