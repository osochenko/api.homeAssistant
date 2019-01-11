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

Route::group(['prefix' => 'auth'], function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');
});

Route::apiResources([
    'expense' => 'Expense\ExpenseController',
    'category-expense' => 'Expense\CategoryExpenseController',
    'allocated-moneys' => 'AllocatedMoney\AllocatedMoneyController',
    'type-allocated-moneys' => 'AllocatedMoney\TypeAllocatedMoneyController',
    'type-utility' => 'Utility\TypeUtilityController',
    'utility-indications' => 'Utility\UtilityIndicationController',
    'wages' => 'Wage\WageController',
    'wage-percentage-distributions' => 'Wage\WagePercentageDistributionController',
    'debts' => 'DebtController',
]);

Route::get('expenses/month/{monthNumber}', 'Expense\ExpenseController@getByMonthNumber');

Route::resource('utility-rate-rule', 'Utility\UtilityRateRuleController', ['only' => ['index']]);
Route::resource('currency', 'CurrencyController', ['only' => ['index']]);
