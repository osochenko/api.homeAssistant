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

//use DB;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('create-user', function () {
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
    $user = \App\Models\User::find(1);
    dd($user->debts);
    $expenseTypeIDs = \App\Models\TypeExpense::where('slug', '!=', 'personal')
        ->pluck('id')
        ->toArray();

    $expensesQuery = \App\Models\Expense::query()
        ->whereMonth('date','=', 4);

    $expensesWithoutTypePersonal = $expensesQuery
        ->whereIn('type_id', $expenseTypeIDs)
        ->get();

    dd($expensesWithoutTypePersonal, $expensesQuery->get());

//    $user = User::find(1);
//    dd($user->utilityIndications);

    $rateRules = \App\Models\UtilityRateRule::whereHas('typeUtility', function ($query) {
        $query->where('user_id', '=', 1);
    })->get();
    dd($rateRules);

//    dd(DB::table('utility_rate_rules')
//        ->join('type_utilities', 'utility_rate_rules.type_utility_id', '=', 'type_utilities.id')
//        ->where('type_utilities.user_id', '=', 1)
//        ->get());
//
//    dd(\App\Models\UtilityIndication::where('type_id', 1)
//        ->whereYear('date', '2018')
//        ->whereMonth('date', '2')
//        ->first());
});
