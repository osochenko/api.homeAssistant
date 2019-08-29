<?php

use App\University;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Vadim Osochenko',
            'email' => 'vadim.osochenko@gmail.com',
            'password' => Hash::make('1qaz2wsx3edchass'),
            'api_token' => Str::random(60),
        ]);
    }
}
