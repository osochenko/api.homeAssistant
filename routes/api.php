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
Route::get('expense/{monthNumber}', 'API\Expense\ExpenseController@getByMonthNumber');

Route::resource('category-expense', 'API\Expense\CategoryExpenseController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);

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
Route::resource('utility-rate-rule', 'API\Utility\UtilityRateRuleController', [
    'only' => ['index']
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

Route::resource('debt', 'API\DebtController', [
    'only' => ['index', 'store', 'update', 'destroy']
]);
