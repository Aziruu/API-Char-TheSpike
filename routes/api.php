<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CharacterController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\CharacterSkillController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function() {
    return response()->json(['message' => 'API works!']);
});

Route::get('/characters/group-by-role', [CharacterController::class, 'groupByRole']);

Route::apiResource('/characters', CharacterController::class);

Route::apiResource('/skills', SkillController::class);

Route::get('/character-skills', [CharacterSkillController::class, 'index']);
Route::post('/character-skills', [CharacterSkillController::class, 'store']);
Route::put('/character-skills', [CharacterSkillController::class, 'update']);
Route::delete('/character-skills', [CharacterSkillController::class, 'destroy']);