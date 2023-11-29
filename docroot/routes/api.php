<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BlogController;

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

Route::post('/registration', [UserController::class, 'registration']);
Route::post('/login', [UserController::class, 'login']);

Route::group([
    "middleware" => ["auth:sanctum"]
], function() {
    Route::get('/views-blog', [BlogController::class, 'viewsBlog']);
    Route::get('/view-blog/{id}', [BlogController::class, 'viewBlog']);
    Route::put('/update-blog/{id}', [BlogController::class, 'updateBlog']);
    Route::delete('/delete-blog/{id}', [BlogController::class, 'deleteBlog']);
    Route::post('/create-blog', [BlogController::class, 'createBlog']);

    Route::post('/logout', [UserController::class, 'logout']);
});
