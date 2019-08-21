<?php
/**
 * Created by PhpStorm.
 * User: artixun
 * Date: 15/08/19
 * Time: 5:46 PM
 */

Route::post('/exception-manager-api/exceptions', 'ExceptionController@index');
Route::get('/exception-manager-api/exceptions/{exceptionId}', 'ExceptionController@show');

Route::get('/{view?}', 'HomeController@index')->where('view', '(.*)')->name('exception-manager');