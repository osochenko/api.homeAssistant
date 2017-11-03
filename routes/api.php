<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('expense', 'API\Expense\ExpenseController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);
Route::resource('category-expense', 'API\Expense\CategoryExpenseController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);

Route::get('type-expense', 'API\Expense\TypeExpenseController@index');

Route::resource('allocated-money', 'API\AllocatedMoney\AllocatedMoneyController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);
Route::resource('type-allocated-money', 'API\AllocatedMoney\TypeAllocatedMoneyController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);

Route::resource('type-utility', 'API\Utility\TypeUtilityController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);
Route::resource('utility-indication', 'API\Utility\UtilityIndicationController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);

Route::resource('wage', 'API\Wage\WageController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);
Route::resource('wage-percentage-distribution', 'API\Wage\WagePercentageDistributionController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);

Route::resource('currency', 'API\CurrencyController', [
    'only' => ['index']
]);

Route::resource('dept', 'API\DebtController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);

Route::any('test', function () {
    return 'true';
});
