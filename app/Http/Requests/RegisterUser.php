<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterUser extends FormRequest
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
            'username' => 'required|string|max:255|unique:users',
            'birthdate' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:255',
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
            'username.required' => 'Le nom d\'utilisateur est requis',
            'username.string' => 'Le nom d\'utilisateur doit être une chaîne de caractères',
            'username.max' => 'Le nom d\'utilisateur ne doit pas dépasser 255 caractères',
            'username.unique' => 'Le nom d\'utilisateur est déjà utilisé',
            
            'birthdate.required' => 'La date de naissance est requise',
            'birthdate.date' => 'La date de naissance doit être au format date (YYYY-MM-DD)',
            'email.required' => 'L\'adresse email est requise',
            'email.string' => 'L\'adresse email doit être une chaîne de caractères',
            'email.email' => 'L\'adresse email doit être une adresse email valide',
            'email.max' => 'L\'adresse email ne doit pas dépasser 255 caractères',
            'email.unique' => 'L\'adresse email est déjà utilisée',
            'password.required' => 'Le mot de passe est requis',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.max' => 'Le mot de passe ne doit pas dépasser 255 caractères',
            
        ];
    }
}
