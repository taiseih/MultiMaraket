<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            [
            'name' => '林崎',
            'email' => 'owner0@owner.com',
            'password' => Hash::make('password123'),
            'created_at' => '2023/1/1 11:11:11'
            ],
            [
            'name' => 'test0',
            'email' => 'owner1@owner.com',
            'password' => Hash::make('password123'),
            'created_at' => '2023/1/1 11:11:11'
            ],
            [
            'name' => 'test1',
            'email' => 'owner2@owner.com',
            'password' => Hash::make('password123'),
            'created_at' => '2023/1/1 11:11:11'
            ],
        ]);
    }
}
