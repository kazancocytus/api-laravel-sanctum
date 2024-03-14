<?php

use App\Http\Controllers\Api\V1\CostumerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Models\Costumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function(){
    Route::apiResource('costumers', CostumerController::class);
    Route::apiResource('invoices', InvoiceController::class);

    Route::post('invoices/bulk', ['uses' => 'InvoiceController@bulkStore']);
    Route::get('costumers/delete/{id}', ['uses' => 'CostumerController@destroy']);
});