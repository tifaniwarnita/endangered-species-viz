<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

\Route::group(['prefix' => 'threats'], function () {
    Route::get('data', [
        'as' => 'threats.data',
        'uses' => 'ThreatController@data'
    ]);
    Route::get('colors', [
        'as' => 'threats.colors',
        'uses' => 'ThreatController@colors'
    ]);
    Route::get('labels', [
        'as' => 'threats.labels',
        'uses' => 'ThreatController@labels'
    ]);
});

\Route::group(['prefix' => 'population'], function () {
    Route::get('data', [
        'as' => 'population.data',
        'uses' => 'PopulationController@data'
    ]);
});

\Route::group(['prefix' => 'species'], function () {
    Route::get('data', [
        'as' => 'species.data',
        'uses' => 'SpeciesController@data'
    ]);
});