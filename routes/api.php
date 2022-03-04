<?php

use App\Http\Controllers\API\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'index']);

Route::post('coba', function (Request $request) {
    $user = User::where('email', $request->email)->first();
    if (!$user || Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'These credentials do not match our records!',
        ], 401);
    }

    $token = $user->createToken('my-app-token')->plainTextToken;

    return response()->json([
        'message' => 'Success!',
        'user' => $user,
        'token' => $token,
    ], 200);
});
