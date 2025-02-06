<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait ValidateStory
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validateStory(): array
    {
        try {
            // Perform the validation
            $validated = $this->request->validate([
                'title' => 'required|max:255',
                'description' => 'required|string|max:500',
                'is_approved' => 'boolean',
            ]);

            // Return a successful response with validated data
            return [
                'code' => 200,
                'data' => $validated,
            ];

        } catch (ValidationException $e) {
            // Return a failed response with validation errors
            return [
                'status' => 422,
                'errors' => $e->errors(),
            ];
        }
    }
}
