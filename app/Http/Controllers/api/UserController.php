<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();
    
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    
        $data = $user->toArray();
        unset($data['password']);
    
        return response()->json([
            'status'=> true,
            'message' => 'Usuário criado com sucesso!',
            'data' => $data
        ], 201);
    }

    public function index(){
        $users = User::orderBy("id", "DESC")->paginate(10);

        return response()->json([
            'status' => true,
            'message' => $users
        ], 200);
    }
}