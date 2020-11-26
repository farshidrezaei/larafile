<?php

namespace FarshidRezaei\LaraFile\Exceptions;

use Exception;
use Illuminate\Support\Facades\Response;

class DirectoryNotFoundException extends BaseException
{
    public function render()
    {
        return Response::json(
            [
                'message' => $this->translateMessage('larafile::exceptions.directory.notFound')
            ],
            404
        );
    }

}
