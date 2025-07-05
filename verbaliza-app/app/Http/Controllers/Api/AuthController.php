<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'password' => 'required|string|min:8',
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

        // Retorna uma resposta de sucesso
        return response()->json([
            'message' => 'Utilizador registado com sucesso!',
            'user' => $user
        ], 201);
    }

    /**
     * Autentica um utilizador e retorna um token.
     */
    public function login(Request $request)
    {
        // Validação dos dados de entrada
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Tenta autenticar o utilizador
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Obtém o utilizador autenticado
        $user = User::where('email', $request['email'])->firstOrFail();

        // Cria um token de acesso
        $token = $user->createToken('auth_token')->plainTextToken;

        // Retorna o utilizador e o token
        return response()->json([
            'message' => 'Login bem-sucedido!',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
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
