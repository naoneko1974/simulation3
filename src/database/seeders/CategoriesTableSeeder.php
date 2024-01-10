<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'レディース'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'メンズ'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'ベビー・キッズ'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'インテリア・住まい・小物'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => '本・音楽・ゲーム'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'おもちゃ・ホビーグッズ'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'コスメ・香水・美容'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => '家電・スマホ・カメラ'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'スポーツ・レジャー'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'ハンドメイド'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'チケット'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => '自動車・オートバイ'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'name' => 'その他'
        ];
        DB::table('categories')->insert($param);
    }
}
