<?php

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


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register', 'AuthController@register');
});

Route::apiResources([
    'expenses' => 'Expense\ExpenseController',
    'category-expenses' => 'Expense\CategoryExpenseController',
    'allocated-moneys' => 'AllocatedMoney\AllocatedMoneyController',
    'type-allocated-moneys' => 'AllocatedMoney\TypeAllocatedMoneyController',
    'type-utilities' => 'Utility\TypeUtilityController',
    'utility-indications' => 'Utility\UtilityIndicationController',
    'wages' => 'Wage\WageController',
    'wage-percentage-distributions' => 'Wage\WagePercentageDistributionController',
    'debts' => 'DebtController',
]);

Route::get('expenses/{monthNumber}', 'Expense\ExpenseController@getByMonthNumber');

Route::resource('utility-rate-rules', 'Utility\UtilityRateRuleController', ['only' => ['index']]);
Route::resource('currencies', 'CurrencyController', ['only' => ['index']]);
