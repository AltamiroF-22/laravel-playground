<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request):JsonResponse
    {
        // Verifica se o usuário forneceu credenciais corretas
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Obtém os dados do usuário autenticado
            $user = Auth::user();

            // Gera um token de API para o usuário autenticado
            $token = $request->user()->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user,
                'message' => 'Você está logado.'
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login ou senha inválida.'
            ], 404);
        }
    }
    
   public function logout(User $user): JsonResponse
   {
       try {
           // Remove todos os tokens do usuário, invalidando o acesso
           $user->tokens()->delete();
           
           return response()->json([
               'status' => true,
               'message' => 'Você agora está deslogado.'
           ], 200);
       } catch (Exception $e) {
           // Captura qualquer erro ao tentar deslogar o usuário
           return response()->json([
               'status' => false,
               'message' => 'Erro ao deslogar!'
           ], 400);
       }
   }
}