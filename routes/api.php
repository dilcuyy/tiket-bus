<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// default route untuk auth user API (biarkan aja dulu)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
