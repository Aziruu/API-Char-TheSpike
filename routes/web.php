<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CharacterController;

Route::get('/', function () {
    return view('welcome');
});
