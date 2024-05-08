<?php

namespace App\Http\Controllers;

use App\Models\WorkType;
use Illuminate\Http\Request;

class WorkTypeController extends Controller
{
    public function store(Request $request){
        // return response()->json($request);

        $request->validate([
            'work_type' => 'required'
        ]);

        $data['work_type'] = $request->work_type;
        $data['team'] = auth()->user()->team;
        $data['user_id'] = auth()->user()->id;

        WorkType::create($data);

        $work_types = WorkType::where('team', auth()->user()->team)
                                ->where('user_id',auth()->user()->id)
                                ->get();
                    // dd($work_types);

         return response()->json($work_types);
    }
}
