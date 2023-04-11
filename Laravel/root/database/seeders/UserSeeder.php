<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 開発環境のみ100レコードを追加する。
        if (app()->isLocal()) {
            // App\Models\Job
            // 全件削除
            User::truncate();
            // JobFactoryクラスを使って100件追加
            User::factory()
                ->count(20)
                ->create();
        }
    }
}
