<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 社員一覧表示機能
        $user = User::orderBy('id', 'asc')->paginate(10);

        return view('admin.index', [
            'users' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'last_name' => $request->last_name,
            'last_name_kana' => $request->last_name_kana,
            'first_name' => $request->first_name,
            'first_name_kana' => $request->first_name_kana,
            'prefecture' => $request->prefecture,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'email' => $request->email,
            'join_date' => $request->join_date,
            'password' => Hash::make($request->password),
        ]);
        return redirect(
            route('user.show', ['user' => $user])
        )->with('message', '新規登録完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view(
            'admin.show',
            ['user' => $user]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.edit', ['user' => $user]);
    }

    public function confirm(UpdateUserRequest $request, User $user)
    {
        // 更新確認画面
        $user->last_name = $request->last_name;
        $user->last_name_kana = $request->last_name_kana;
        $user->first_name = $request->first_name;
        $user->first_name_kana = $request->first_name_kana;
        $user->prefecture = $request->prefecture;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->email = $request->email;
        $user->join_date = $request->join_date;
        return view('admin.confirm', ['user' => $user]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request,User $user)
    {

        $user->update([

            'last_name' => $request->last_name,
            'last_name_kana' => $request->last_name_kana,
            'first_name' => $request->first_name,
            'first_name_kana' => $request->first_name_kana,
            'prefecture' => $request->prefecture,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'email' => $request->email,
            'join_date' => $request->join_date,
        ]);
        return redirect(
            route('user.show', ['user' => $user])
        )->with('message', '更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users'));
    }
}
