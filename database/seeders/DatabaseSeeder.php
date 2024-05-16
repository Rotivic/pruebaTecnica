<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
        [ 
            'i_user' => '11678', 
            'dni' => '26248931C', 
        ],
        [
            'i_user' => '11223', 
            'dni' => '12345678A', 
        ]
        ]);
    }
}
