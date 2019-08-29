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
        'expense-categories' => 'Expense\ExpenseCategoryController',
        'expense-events' => 'Expense\ExpenseEventController',
        'expense-products' => 'Expense\ExpenseProductController',
        'type-utilities' => 'Utility\TypeUtilityController',
        'utility-indications' => 'Utility\UtilityIndicationController',
        'debts' => 'DebtController',
    ]);

    Route::get('expenses/{year}/{month}', 'Expense\ExpenseController@getByMonthAndYear');
    Route::get('utility-rate-rules', 'Utility\UtilityRateRuleController@index');
});
