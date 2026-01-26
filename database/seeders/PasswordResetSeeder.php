<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasswordResetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('password_resets')->insert([
            'user_id' => 1,
            'token' => Str::random(64),
            'expires_at' => now()->addMinutes(30),
            'created_at' => now(),
        ]);
    }
}
