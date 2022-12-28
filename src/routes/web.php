<?php

//if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    //error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
//}

Route::resource('/cms/fin/transactions/categories','budisteikul\fin\Controllers\CategoryController',[ 'names' => 'route_fin_categories' ])
    ->middleware(['web','auth','verified','CoreMiddleware']);
    
Route::resource('/cms/fin/transactions','budisteikul\fin\Controllers\TransactionController',[ 'names' => 'route_fin_transactions' ])
    ->middleware(['web','auth','verified','CoreMiddleware']);

Route::resource('/cms/fin/profitloss', 'budisteikul\fin\Controllers\SalesController',[ 'names' => 'route_fin_profitloss' ])->middleware(['web','auth','verified','CoreMiddleware']);

Route::resource('/cms/fin/banking/currency', 'budisteikul\fin\Controllers\CurrencyController',[ 'names' => 'route_fin_currency' ])->middleware(['web','auth','verified','CoreMiddleware']);
Route::resource('/cms/fin/banking', 'budisteikul\fin\Controllers\BankingController',[ 'names' => 'route_fin_banking' ])->middleware(['web','auth','verified','CoreMiddleware']);

Route::resource('/cms/fin/payment', 'budisteikul\fin\Controllers\PaymentController',[ 'names' => 'route_fin_payment' ])->middleware(['web','auth','verified','CoreMiddleware']);

Route::resource('/cms/fin/recipient', 'budisteikul\fin\Controllers\RecipientController',[ 'names' => 'route_fin_recipient' ])->middleware(['web','auth','verified','CoreMiddleware']);

Route::get('/cms/test','budisteikul\fin\Controllers\TestController@test')->middleware(['web','auth','verified','CoreMiddleware']);