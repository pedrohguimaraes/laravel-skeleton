<?php

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::apiResource('orders', OrdersController::class);
});




