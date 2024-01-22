<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Models\Setting;
use App\Http\Resources\User\UserResource;

use App\Notifications\Auth\UserRegister;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use stdClass;
use Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('register', ['only' => ['register']]);
        $this->middleware('auth:sanctum', ['except' => ['login', 'register', 'recover', 'reset', 'verify']]);
        $this->middleware('demo', ['only' => ['register', 'recover', 'reset']]);
        $this->middleware('captcha', ['only' => ['login', 'register', 'recover', 'reset']]);
    }

    /**
     * @param  RegisterRequest  $request
     * @return JsonResponse
     * @throws Exception
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $request->validated();

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));

        $user->save();

        $objNotificationData = new stdClass();
        $objNotificationData->user = $user;


        $token = $user->createToken(Str::slug(config('app.name') . '_auth_token', '_'))->plainTextToken;
        return response()->json(['token' => $token, 'user' => new UserResource($user)]);
    }

}
