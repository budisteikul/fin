<?php

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::resource('/cms/fin/categories','budisteikul\fin\Controllers\CategoryController',[ 'names' => 'route_fin_categories' ])
    ->middleware(['web','auth','verified','CoreMiddleware']);
Route::resource('/cms/fin/transactions','budisteikul\fin\Controllers\TransactionController',[ 'names' => 'route_fin_transactions' ])
    ->middleware(['web','auth','verified','CoreMiddleware']);
Route::resource('/cms/fin/profitloss', 'budisteikul\fin\Controllers\SalesController',[ 'names' => 'route_fin_profitloss' ])->middleware(['web','auth','verified','CoreMiddleware']);
Route::resource('/cms/fin/revenue', 'budisteikul\fin\Controllers\RevenueController',[ 'names' => 'route_fin_profitloss' ])->middleware(['web','auth','verified','CoreMiddleware']);
