<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'messenger', 'namespace' => 'Sujit\Messenger\Http\Controllers'], function() {
    Route::get('/', 'DashboardController@index')->name('sujit.messenger.dashboard');
});

