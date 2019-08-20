<?php
/**
 * Created by PhpStorm.
 * User: artixun
 * Date: 20/08/19
 * Time: 12:59 PM
 */

namespace Artixun\LaravelExceptionManager;

use Throwable;

class ExceptionContext
{
    /**
     * Get the exception code context for the given exception.
     *
     * @param  \Throwable  $exception
     * @return array
     */
    public static function get(Throwable $exception)
    {
        return collect(explode("\n", file_get_contents($exception->getFile())))
            ->slice($exception->getLine() - 10, 20)
            ->mapWithKeys(function ($value, $key) {
                return [$key + 1 => $value];
            })->all();
    }
}