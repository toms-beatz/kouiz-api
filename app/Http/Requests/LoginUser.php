<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message' => 'Erreur de validation',
            'errorsList' => $validator->errors(),
        ], 422, [], JSON_UNESCAPED_UNICODE));
    }

    public function messages() {
        return [
            'email.required' => 'L\'adresse email est requise',
            'email.email' => 'L\'adresse email doit être une adresse email valide',
            'email.exists' => 'L\'adresse email n\'existe pas',
            'password.required' => 'Le mot de passe est requis',
        ];
    }
}
