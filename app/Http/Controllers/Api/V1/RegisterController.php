<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{    
    /**
     * register
     *
     * @param  mixed $request
     * @return Json
     */
    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();
        
        // Create the user
        $user = User::create($data);

        // Login the user
        $token = auth()->login($user);

        // Payload 
        $payload = [...$user->toArray(), 'token' => $token];

        return $this->sendSuccess('Authenticated', $payload);
    }
}
