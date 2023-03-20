<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            // 'email' => 'required|max:100|email:rfc,dns|unique:user,email',
            'join_date' => 'required',
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
        ];
    }

    /**
     * 検証エラーでリダイレクトする URL を取得します。 (Get the URL to redirect to on a validation error.)
     * @see https://github.com/laravel/framework/blob/v9.27.0/src/Illuminate/Foundation/Http/FormRequest.php#L143-L161
     */
    protected function getRedirectUrl()
    {
        if (request()->routeIs('*.update')) {
            // 確認画面→更新バリデーションエラーの場合、編集画面に遷移。
            //   親クラスのgetRedirectUrlでは、パラメータつきURL生成に対応していないため、以下の方法をとる。
            $url = $this->redirector->getUrlGenerator();
            // 編集画面のURLを取得
            return $url->route('user.edit', ['user' => request()->route()->parameter('user')]);
        }
        // 親クラス(Illuminate\Foundation\Http\FormRequest) の getRedirectUrl を実行
        return parent::getRedirectUrl();
    }
}
