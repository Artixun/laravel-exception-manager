<?php
/**
 * Created by PhpStorm.
 * User: artixun
 * Date: 17/08/19
 * Time: 1:06 PM
 */

namespace Artixun\LaravelExceptionManager\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * Display the Exception Manager view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laravel-exception-manager::layout', [
            'exceptionScriptVariables' => ['path' => config('laravel-exception-manager.path')],
        ]);
    }
}