<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use  App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Work;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //勤怠データ一覧表示
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
        $firstOfMonth = Carbon::now()->firstOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $dateList = [];
        $dateList[$firstOfMonth->format('Y-m-d')] =$firstOfMonth->format('d日');

        for ($i = 0; true; $i++) {
            $date = $firstOfMonth->addDays(1);
            if ($date > $endOfMonth) {
                break;
            }
            $dateList[$date->format('Y-m-d')]=$date->format('d日');
        }

        return view('user.work.index', [
            'works' => $works,
            'thisYear'   => $thisYear,
            'thisMonth'   => $thisMonth,
            'dateList'   => $dateList,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user,Request $request)
    {
        $date=Carbon::now()->format('Y-m-d');
        Work::create([
            'user_id' => $user->id,
            'work_content' =>$request->work_content,
            'comment' =>$request->comment,
            'date' =>$date,
            'work_start_time' =>$request->work_start_time,
            'work_end_time' =>$request->work_end_time,
            'break_time' =>$request->break_time,
        ]);
        return redirect(
            route('work', ['user' => $user])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Work $work)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user, Work $work)
    {
        //申請登録
        $work->update([
            'work_content' =>$request->work_content,
            'comment' =>$request->comment,
            'date' =>$request->date,
            'work_start_time' =>$request->work_start_time,
            'work_end_time' =>$request->work_end_time,
            'break_time' =>$request->break_time,
            'status_id'  =>2,
        ]);
        return redirect(
            route('work', [
                'user' => $user,
                'work' => $work,
                ])
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function index2(User $user,Request $request)
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

        $firstOfMonth = Carbon::now()->firstOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $dateList = [];
        $dateList[$firstOfMonth->format('Y-m-d')] =$firstOfMonth->format('d日');

        for ($i = 0; true; $i++) {
            $date = $firstOfMonth->addDays(1);
            if ($date > $endOfMonth) {
                break;
            }
            $dateList[$date->format('Y-m-d')]=$date->format('d日');
        }




        return view('user.work.index', [
            'works' => $works,
            'thisYear'    =>$year,
            'thisMonth'   => $month,
            'dateList'   => $dateList,
        ]);
    }
}
