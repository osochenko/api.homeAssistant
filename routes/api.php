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

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::group(['middleware' => 'auth:api'], function () {
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

    Route::get('expenses/month/{monthNumber}', 'Expense\ExpenseController@getByMonthNumber');
    Route::get('currencies', 'CurrencyController@index');
    Route::get('utility-rate-rules', 'Utility\UtilityRateRuleController@index');
});
