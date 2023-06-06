<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login', 'register']]); // trocar o middleware p/ um de resposta mais completa do que o auth:api

    }

    /**
     * Register a new User
     * 
     * @param  Request  $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) 
    {        
        // Caso não seja válido, retorna automaticamente um JSON com mensagem de 'data invalid' e motivo.
        $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|confirmed|min:4|max:8|'
        ]);
    
        $user = new User();
        $user->fill(request(['name', 'email']));
        $user->password = Hash::make($request->password);

        $user->save();

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login() 
    {   
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['erro' => 'Não autorizado'], 401);
        }
        return $this->respondWithToken($token);
        
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me() 
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['mensagem' => 'Logout realizado com sucesso']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh()); // Se estiver usando VSCODE, Intelephense pode acusar refresh() comométodo indefinido, mas está funcionando normallmente
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 // Se estiver usando VSCODE, Intelephense pode acusar factory() comométodo indefinido, mas está funcionando normallmente
        ]);
    }
}
