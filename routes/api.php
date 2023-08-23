<?php

use App\Events\ChatMessagesEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::post('/chat', function (Request $req) {
    $validator = Validator::make($req->all(), [
        'message' => 'required|string'
    ]);

    if ($validator->fails())
        return response()->json($validator->messages(), 422);

    if (auth()->user()->name === 'tg_bot') {
        event(new ChatMessagesEvent($req->username, $req->message));
    } else {
        event(new ChatMessagesEvent(auth()->user()->name, $req->message));

        Http::post('http://127.0.0.1:3000/api/sendtochat', [
            'username' => auth()->user()->name,
            'message' => $req->message
        ]);
    }

    return response()->json([
        'status' => 'success'
    ]);
})->middleware('auth:sanctum');

Route::post('/authenticate', function (Request $req) {
    $user = User::where('name', '=', $req->name)->first();

    if ($user !== null) {
        if ($user->password !== $req->password) {
            return response()->json([
                "error" => 'Unauthenticated'
            ], 401);
        }

        $token = $user->createToken($req->name)->plainTextToken;

        return response()->json([
            "token" => $token
        ], 200);
    }

    $newUser =  User::create([
        "name" => $req->name,
        "password" => $req->password
    ]);

    $token = $newUser->createToken($req->name)->plainTextToken;

    return response()->json([
        "token" => $token
    ], 200);
});
