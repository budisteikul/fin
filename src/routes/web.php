<?php

//if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    //error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
//}

Route::get('/cms/fin/transactions/categories/structure','budisteikul\fin\Controllers\CategoryController@structure')->middleware(['web','auth','verified','CoreMiddleware']);

Route::resource('/cms/fin/transactions/categories','budisteikul\fin\Controllers\CategoryController',[ 'names' => 'route_fin_categories' ])
    ->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);
    
Route::resource('/cms/fin/transactions','budisteikul\fin\Controllers\TransactionController',[ 'names' => 'route_fin_transactions' ])
    ->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);



Route::resource('/cms/fin/profitloss', 'budisteikul\fin\Controllers\SalesController',[ 'names' => 'route_fin_profitloss' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);

Route::resource('/cms/fin/profitloss-old', 'budisteikul\fin\Controllers\SalesControllerOld',[ 'names' => 'route_fin_profitloss_old' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);

Route::resource('/cms/fin/banking', 'budisteikul\fin\Controllers\BankingController',[ 'names' => 'route_fin_banking' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);

Route::resource('/cms/fin/report/asset', 'budisteikul\fin\Controllers\AssetController',[ 'names' => 'route_fin_asset' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);

Route::resource('/cms/fin/report/monthly', 'budisteikul\fin\Controllers\ReportMonthlyController',[ 'names' => 'route_fin_report_monthly' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);


Route::resource('/cms/fin/tax', 'budisteikul\fin\Controllers\TaxController',[ 'names' => 'route_fin_tax' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);

Route::resource('/cms/fin/payment', 'budisteikul\fin\Controllers\PaymentController',[ 'names' => 'route_fin_payment' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);

Route::resource('/cms/fin/transfer/recipient', 'budisteikul\fin\Controllers\RecipientController',[ 'names' => 'route_fin_recipient' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);

Route::resource('/cms/fin/transfer/currency', 'budisteikul\fin\Controllers\CurrencyController',[ 'names' => 'route_fin_currency' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);

Route::resource('/cms/fin/transfer', 'budisteikul\fin\Controllers\TransferController',[ 'names' => 'route_fin_transfer' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);

Route::resource('/cms/fin/neraca', 'budisteikul\fin\Controllers\NeracaController',[ 'names' => 'route_fin_neraca' ])->middleware(['web','auth','verified','CoreMiddleware','LevelMiddleware']);


Route::get('/cms/fin/report/pdf/{tahun}','budisteikul\fin\Controllers\LaporanController@pdf')->middleware(['web','auth','verified','CoreMiddleware']);
