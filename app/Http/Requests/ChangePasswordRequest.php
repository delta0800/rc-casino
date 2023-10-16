<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MatchOldPassword;
use App\Rules\SamePassword;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'string', new MatchOldPassword],
            'password' => ['required', 'confirmed', 'string', new SamePassword, Password::min(8)],
        ];
    }
}
