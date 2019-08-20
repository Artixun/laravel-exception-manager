<?php
/**
 * Created by PhpStorm.
 * User: artixun
 * Date: 19/08/19
 * Time: 4:38 PM
 */

namespace Artixun\LaravelExceptionManager\Http\Controllers;

use Artixun\LaravelExceptionManager\Models\ErrorLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ExceptionController extends Controller
{
    /**
     * Display the Exceptions.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $entries = ErrorLog::on(config('laravel-exception-manager.database_connection'))
            ->when($request->before, function ($query) use ($request) {
                return $query->where('id', '<', $request->before);
            })
            ->take($request->take ?? 50)
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'entries' => $entries
        ]);
    }
}