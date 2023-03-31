<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Work;
use App\Models\User;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(User $user)
    {
        $day = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->format('G:i:s');
        //出勤新規登録
        Work::create([
            'user_id' => $user->id,
            'date' => $day,
            'work_start_time' => $time,
        ]);
        return redirect(
            route('work', ['user' => $user])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $day = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->format('G:i:s');
        //退勤更新
        Work::where('user_id', '=', $user->id)
            ->where('date', '=', $day)
            ->update(['work_end_time' => $time]);

        return redirect(
            route('work', ['user' => $user])
        );
    }
}
