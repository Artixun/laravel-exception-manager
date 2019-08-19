<?php
/**
 * Created by PhpStorm.
 * User: artixun
 * Date: 15/08/19
 * Time: 5:46 PM
 */

Route::get('/{view?}', 'HomeController@index')->where('view', '(.*)')->name('exception-manager');

Route::post('exceptions', 'ExceptionController@index');