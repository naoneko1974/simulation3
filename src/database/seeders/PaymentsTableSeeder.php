<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'payment' => 'クレジット払い'
        ];
        DB::table('payments')->insert($param);
        $param = [
            'payment' => 'コンビニ払い'
        ];
        DB::table('payments')->insert($param);
        $param = [
            'payment' => 'd払い'
        ];
        DB::table('payments')->insert($param);
        $param = [
            'payment' => 'au'
        ];
        DB::table('payments')->insert($param);
        $param = [
            'payment' => 'ソフトバンク'
        ];
        DB::table('payments')->insert($param);
        $param = [
            'payment' => 'Famipay'
        ];
        DB::table('payments')->insert($param);
        $param = [
            'payment' => 'その他'
        ];
        DB::table('payments')->insert($param);
    }
}
