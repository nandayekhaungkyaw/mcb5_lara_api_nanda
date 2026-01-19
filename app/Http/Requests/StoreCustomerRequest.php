<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // must be true to allow requests
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'birth' => 'nullable|date',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
        ];
    }

    // 🔹 Return JSON when validation fails
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422)); // 422 = Unprocessable Entity
    }

    // Optional: custom messages
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'This email is already taken',
            'birth.date' => 'Birth must be a valid date',
            'phone.max' => 'Phone cannot exceed 20 characters',
        ];
    }
}
