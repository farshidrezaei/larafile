<?php

namespace FarshidRezaei\LaraFile\Exceptions;

use Exception;
use Illuminate\Support\Facades\Response;

class BaseException extends Exception
{
    protected function translateMessage(string $message = '')
    {
        return __(
            $message,
            [],
            config('larafile.language', config('larafile.languageFallback', 'en'))
        );
    }


}
