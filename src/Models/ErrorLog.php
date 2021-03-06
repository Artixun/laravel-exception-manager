<?php
/**
 * Created by PhpStorm.
 * User: artixun
 * Date: 02/08/19
 * Time: 4:23 PM
 */

namespace Artixun\LaravelExceptionManager\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'content' => 'json'
    ];
}