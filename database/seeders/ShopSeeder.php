<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => 'オーナー1のショップ名です',
                'information' => '店舗情報が入ります。店舗情報が入ります。店舗情報が入ります。',
                'filename' => 'sample1.jpg',
                'is_selling' => true,
                'created_at' => '2023/1/1 11:11:11'
            ],
            [
                'owner_id' => 2,
                'name' => 'オーナー2のショップ名です',
                'information' => '店舗情報が入ります。店舗情報が入ります。店舗情報が入ります。',
                'filename' => 'sample2.jpg',
                'is_selling' => false,
                'created_at' => '2023/1/1 11:11:11'
            ],
        ]);
    }
}
