<?php

namespace ATLauncher\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    /**
     * Get the response for a forbidden operation.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function forbiddenResponse()
    {
        return response()->json([
            'code' => 403,
            'error' => 'You are not authorized to make that request.'
        ], 403);
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $errors)
    {
        return response()->json([
            'code' => 422,
            'error' => 'Validation errors when processing data.',
            'errors' => $errors
        ], 422);
    }
}
