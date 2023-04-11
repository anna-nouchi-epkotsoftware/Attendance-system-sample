<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'last_name' => 'required|max:100',
            'last_name_kana' => 'required|max:100',
            'first_name' => 'required|max:100',
            'first_name_kana' => 'required|max:100',
            'email' => 'required|max:100|unique:users,email',
            'join_date' => 'required',
            'password' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'last_name' => '姓',
            'last_name_kana' => '姓(ふりがな)',
            'first_name' => '名前',
            'first_name_kana' => '名前(ふりがな)',
            'email' => 'メールアドレス',
            'join_date' => '入社日',
            'password' => 'パスワード',
        ];
    }
}
