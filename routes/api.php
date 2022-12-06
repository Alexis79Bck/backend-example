<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\PublisherController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PublisherResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
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

Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class,'index']);

    Route::post('/new', [BookController::class,'store']);

    Route::get('/{id}', [BookController::class,'show']);

    Route::put('/{id}',[BookController::class,'update']);

    Route::delete('/{id}',[BookController::class,'destroy']);


});

Route::prefix('publishers')->group(function () {
    Route::get('/', [PublisherController::class,'index']);

    Route::post('/new', [PublisherController::class,'store']);

    Route::get('/{id}', [PublisherController::class,'show']);

    Route::put('/{id}', [PublisherController::class,'update']);

    Route::delete('/{id}', [PublisherController::class,'destroy']);



});

Route::prefix('authors')->group(function () {
    Route::get('/', [AuthorController::class,'index']);

    Route::post('/new', [AuthorController::class,'store']);

    Route::get('/{id}', [AuthorController::class,'show']);

    Route::put('/{id}', [AuthorController::class,'update']);

    Route::delete('/{id}', [AuthorController::class,'destroy']);



});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class,'index'] );

    Route::post('/new', [CategoryController::class,'store']);

    Route::get('/{id}',[CategoryController::class,'show']);

    Route::put('/{id}',[CategoryController::class,'update']);

    Route::delete('/{id}',[CategoryController::class,'destroy']);


});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
