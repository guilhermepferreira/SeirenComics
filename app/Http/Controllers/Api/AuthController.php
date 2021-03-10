<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Managers\User as Usermanager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;
use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);


        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $profile = new Usermanager(UserModel::find(Auth::id()));
        return response()->json(['user' => $profile->getProfile(), 'access_token' =>$token], 200);
    }

    public function loginGoogle(Request $request)
    {
        $credentials = $request->all();

        $user = UserModel::where('email',$credentials['email'])->first();

        if(isEmpty($user)){
            $user = UserModel::create([
               'email' =>  $credentials['email'],
                'name' =>  $credentials['name'],
                'age_verification' =>  1,
                'user_type_id' =>  2,
                'google_id' =>  $credentials['googleId'],
                'password' => Hash::make($credentials['password']),
            ]);
            $token = JWTAuth::fromUser($user);
        } else {
            if ($user->google_id == $credentials['googleId']){
                $token = JWTAuth::fromUser($user);
            }
        }

        if (isEmpty($token)){
            return response()->json(['message' => 'Error, impossivel gerar o token.'], 200);
        }

        $profile = new Usermanager($user);
        return response()->json(['user' => $profile->getProfile(), 'access_token' =>$token], 200);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
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
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
