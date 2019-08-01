<?php

namespace Artixun\LaravelExceptionManager;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Artixun\LaravelExceptionManager\Skeleton\SkeletonClass
 */
class LaravelExceptionManagerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-exception-manager';
    }
}
