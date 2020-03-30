<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'messenger', 'namespace' => 'Sujit\Messenger\Http\Controllers'], function() {
    Route::get('/', 'DashboardController@index')->name('sujit.messenger.dashboard');
    Route::any('{vendor}/{service}/receive', 'DashboardController@receiveMessage')->name('sujit.messenger.receive');
    Route::any('{vendor}/{service}/receive-callback', 'DashboardController@receiveCallback')->name('sujit.messenger.receive.callback');
});
