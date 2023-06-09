<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::apiResource('photos', 'PhotoController');

Route::post('/auth/login', [AuthController::class, 'loginUser']);

//Comment - public
Route::post('comments',[CommentController::class, 'createComment']);

//End comment public


//comment Middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::get('latest-comment',[CommentController::class, 'commentLatest']);


    Route::get('comments',[CommentController::class, 'getComment']);
    Route::get('all-comment',[CommentController::class, 'AllComment']);
    Route::put('comments/{id}',[CommentController::class, 'changeStatus']);
    Route::delete('comments/{id}',[CommentController::class, 'deleteComment']);



    
    // ...
});
//End comment Middleware

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
    

