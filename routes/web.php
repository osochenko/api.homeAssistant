<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('create-use', function () {
    $input = [
        'name' => 'Vadim Osochenko',
        'email' => 'rokerez@yandex.ua',
        'password' => '123456',
    ];
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $token = $user->createToken('WebApp')->accessToken;

    return response()->json(['token' => $token]);
});
Route::get('test', function () {
    dd(\App\Models\UtilityIndication::where('type_id', 1)
        ->whereYear('date', '2018')
        ->whereMonth('date', '2')
        ->first());
});
