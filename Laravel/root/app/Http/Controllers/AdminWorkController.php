<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/work/index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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

    public function search(Request $request)
    {
        $last_name = "%$request->last_name%";
        $first_name = "%$request->first_name%";
        $id = $request->id;

        if ($id !== null) {
            $users = DB::table('users')
                ->select('users.id', 'users.last_name', 'users.first_name')
                ->join('works', 'users.id', '=', 'works.user_id')
                ->where('users.id', '=', $id)
                ->whereYear('works.date', $request->year)
                ->whereMonth('works.date', $request->month)
                ->groupBy('users.id')
                ->get();

            return view('admin.work.index', [
                'users' => $users,
                'searchYear'  => $request->year,
                'searchMonth' => $request->month,
            ]);
        }
        $users = DB::table('users')
            ->select('users.id', 'users.last_name', 'users.first_name')
            ->join('works', 'users.id', '=', 'works.user_id')
            ->whereYear('works.date', $request->year)
            ->whereMonth('works.date', $request->month)
            ->where(function ($query) use ($last_name, $first_name) {
                $query->where('last_name', 'like', $last_name)
                    ->orWhere('first_name', 'like', $first_name);
            })
            ->groupBy('users.id')
            ->get();

        return view('admin.work.index', [
            'users' => $users,
            'searchYear'  => $request->year,
            'searchMonth' => $request->month,
        ]);
    }
}
