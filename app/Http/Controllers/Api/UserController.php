<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiGeneralValidation;
use App\Models\Lookup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(ApiGeneralValidation $request)
    {
        try {
            $data = $request->validated();
            $data['name'] = ['en' => $request->name, 'ar' => $request->name];
            $data['user_name'] = Str::slug($request->name);
            $data['password'] = Hash::make($request->password);
            $data['role_id'] =  Lookup::where('key' , $request->type)->first()->id  ?? null;
            $user = User::create($data);

            if ($user) {
                $user->token =  $user->createToken('token-name', ['admin-dashboard'])->plainTextToken;
                return $this->responseSuccess($user);
            }
            return $this->responseFail();
        } catch (\Throwable $th) {
            if (config('app.debug', false)) {
                return $th;
            }
        }
    }

    public function login(ApiGeneralValidation $request)
    {
        try {
            if (
                Auth::attempt(['email' => $request->key, 'password' => $request->password]) ||
                Auth::attempt(['user_name' => $request->key, 'password' => $request->password]) ||
                Auth::attempt(['mobile' => $request->key, 'password' => $request->password])
            ) {
                $user = Auth::user();
                $user->token =  $user->createToken('token-name', ['admin-dashboard'])->plainTextToken;
                return $this->responseSuccess($user);
            }
            return $this->responseFail('wrong credentials', 401);
        } catch (\Throwable $th) {
            if (config('app.debug', false)) {
                return $th;
            }
        }
    }


    public function logout()
    {
        try {
            request()->user()->currentAccessToken()->delete();
            return $this->responseSuccess(true);
        } catch (\Throwable $th) {
            if (config('app.debug', false)) {
                return $th;
            }
        }
    }
}
