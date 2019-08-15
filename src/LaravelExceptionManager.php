<?php

namespace Artixun\LaravelExceptionManager;

use Artixun\LaravelExceptionManager\Models\ErrorLog;

class LaravelExceptionManager
{
    public function reportException($exception)
    {
        $content = [];
        $content['class'] = get_class($exception);
        $content['file'] = $exception->getFile();
        $content['line'] = $exception->getLine();
        $content['message'] = $exception->getMessage();
        $content['trace'] = $exception->getTrace();

        ErrorLog::create([
            'content' => json_encode($content)
        ]);
    }
}
