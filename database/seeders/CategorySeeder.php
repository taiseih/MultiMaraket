<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('primary_categories')->insert([[
            'name' => 'キッチン用品',
            'sort_order' => '1',
        ],
        [
            'name' => '引っ越し祝い・ギフト',
            'sort_order' => '2',
        ],
        [
            'name' => '家電',
            'sort_order' => '3',
        ],
        ]);

        DB::table('secondary_categories')->insert([[
            'name' => 'フライパン',
            'sort_order' => '1',
            'primary_category_id' => 1
        ],
        [
            'name' => '食器',
            'sort_order' => '2',
            'primary_category_id' => 1,
        ],
        [
            'name' => 'グラス',
            'sort_order' => '3',
            'primary_category_id' => 1,
        ],
        [
            'name' => 'ギフトセット',
            'sort_order' => '1',
            'primary_category_id' => 2,
        ],
        [
            'name' => '引っ越しセット',
            'sort_order' => '2',
            'primary_category_id' => 2,
        ],
        [
            'name' => '掃除用具',
            'sort_order' => '3',
            'primary_category_id' => 2,
        ],
        [
            'name' => '冷蔵庫',
            'sort_order' => '1',
            'primary_category_id' => 3,
        ],
        [
            'name' => '電子レンジ',
            'sort_order' => '2',
            'primary_category_id' => 3,
        ],
        [
            'name' => '洗濯機',
            'sort_order' => '3',
            'primary_category_id' => 3,
        ],
        ]);
    }
}
