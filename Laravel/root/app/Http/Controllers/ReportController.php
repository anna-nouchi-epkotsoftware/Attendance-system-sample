<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(User $user)
    {
        //出勤新規登録
        $day = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->format('G:i:s');

        $works = Work::where('user_id', '=', $user->id)
            ->where('date', '=', $day)
            ->get();
        $res = $works->isEmpty();

        //1日1回しか押せないように処理している
        if ($res) {
            Work::create([
                'user_id' => $user->id,
                'date' => $day,
                'work_start_time' => $time,
                'status_id' => 1,
            ]);
            return redirect()->route('work', ['user' => $user])->with('success', 'おはようございます！今日も1日頑張りましょう！');
        } else {
            return redirect()->route('work', ['user' => $user])->with('danger', '出勤ボタンはすでに押されています。');
        }
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
        //退勤更新
        $day = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->format('G:i:s');

        $works =Work::where('user_id', '=', $user->id)
            ->where('date', '=', $day)
            ->get();
        $res = $works->whereNotNull('work_end_time');
        $res = $res->isEmpty();

        //1日1回しか押せないように処理している
        if ($res) {
            Work::where('user_id', '=', $user->id)
                ->where('date', '=', $day)
                ->update(['work_end_time' => $time]);
            return redirect()->route('work', ['user' => $user])->with('success', '今日も1日お疲れ様でした！');
        } else {
            return redirect()->route('work', ['user' => $user])->with('danger', '退勤ボタンはすでに押されています。');
        }
    }
}
