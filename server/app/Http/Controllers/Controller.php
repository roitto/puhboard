<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Overwritten version of the lumen validation response to be more JSONAPI -like.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $errors
     * @return mixed;
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        if (isset(static::$responseBuilder)) {
            return call_user_func(static::$responseBuilder, $request, $errors);
        }

        return new JsonResponse((object) [
            'errors' => (object) [
                'id' => (string) 422,
                'status' => (string) '422',
                'code' => (string) 'validation',
                'attributes' => $errors,
            ],
        ], 422);
    }
}
