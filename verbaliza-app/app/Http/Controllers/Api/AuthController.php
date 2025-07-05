<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Cria um novo utilizador.
     */
    public function register(Request $request)
    {
        // Validação dos dados de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Criação do utilizador
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Registo bem-sucedido. Por favor, verifique o seu e-mail.'], 201);
    }

    /**
     * Autentica um utilizador e retorna um token.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1. Encontrar o utilizador pelo e-mail
        $user = User::where('email', $request->email)->first();

        // 2. Verificar se o utilizador existe E se a senha está correta
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas.'], 401);
        }

        // 3. Verificar se o e-mail do utilizador foi verificado
        if (! $user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'O seu endereço de e-mail não foi verificado.',
                'email_not_verified' => true
            ], 403); // 403 Forbidden é mais apropriado aqui
        }

        // 4. Se tudo estiver correto, criar e retornar o token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login bem-sucedido!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    /**
     * Faz logout do utilizador (revoga o token atual).
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso!']);
    }
}
