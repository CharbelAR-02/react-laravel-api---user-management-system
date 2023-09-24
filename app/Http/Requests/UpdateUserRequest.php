<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:users,email,' . $this->id, //this because maybe the user will not change the email so the validation will complain that the email is not unique so the third argument is the id of the user we want to exclude the unique validation on
            'password' => [
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->symbols(),
            ]
        ];
    }
}
