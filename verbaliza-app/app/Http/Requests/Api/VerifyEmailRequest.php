<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;

class VerifyEmailRequest extends EmailVerificationRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Encontra o utilizador pelo ID na rota
        $user = User::find($this->route('id'));

        // Se o utilizador não for encontrado, a autorização falha imediatamente.
        // Isto previne o erro "call to a member function on null".
        if (! $user) {
            return false;
        }

        // Se o utilizador existir, continua com a verificação padrão do Laravel (comparar o hash)
        if (! hash_equals((string) $this->route('hash'), sha1($user->getEmailForVerification()))) {
            return false;
        }

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
        ];
    }
}
