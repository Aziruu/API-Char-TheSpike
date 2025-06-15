<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CharacterController;
use App\Http\Controllers\API\SkillCharactersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function() {
    return response()->json(['message' => 'API works!']);
});

Route::get('/characters/group-by-role', [CharacterController::class, 'groupByRole']);

Route::apiResource('/characters', CharacterController::class);

Route::apiResource('/skill-characters', SkillCharactersController::class);
