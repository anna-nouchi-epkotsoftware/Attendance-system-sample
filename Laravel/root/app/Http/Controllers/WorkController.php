<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use  App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Work;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //今月の勤怠データ一覧表示
        $thisYear = Carbon::now()->year;
        $thisMonth = Carbon::now()->month;
        $id=$user->id;

        $works = DB::table('users')
        ->join('works', 'users.id', '=', 'works.user_id')
        ->whereYear('works.date',$thisYear)
        ->whereMonth('works.date',$thisMonth)
        ->where('users.id', '=', $id)
        ->orderBy('works.date', 'asc')
        ->get();

        return view('user.work.index', [
            'works' => $works,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param　App\Models\User $user
     * @param　App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Work $work)
    {
        //詳細画面表示
        return view('user.work.create',[
            'user' => $user,
            'work' => $work,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param　App\Models\User $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,Request $request)
    {
        //月変更処理
        $year = $request->year;
        $month = $request->month;
        $id=$user->id;

        $works = DB::table('users')
        ->join('works', 'users.id', '=', 'works.user_id')
        ->whereYear('works.date',$year)
        ->whereMonth('works.date',$month)
        ->where('users.id', '=', $id)
        ->orderBy('works.date', 'asc')
        ->get();

        return view('user.work.index', [
            'works' => $works,
            'searchYear'    =>$year,
            'searchMonth'   => $month,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param　App\Models\User $user
     * @param　App\Models\Work $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user, Work $work)
    {
        //申請登録
        $validated = $request->validate([
            'break_time' => 'required',
        ]);

        $work->update([
            'work_content' =>$request->work_content,
            'comment' =>$request->comment,
            'break_time' =>$request->break_time,
            'status_id'  =>2,
        ]);
        return redirect()->
            route('work.index', [
                'user' => $user,
                'work' => $work,
                ])->
            with('success', '申請完了しました。');
    }
}
