<?php

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

Route::get('/books', function(){
    return BookResource::collection(Book::all());
});

Route::get('/book/{id}', function($id){
    return new BookResource(Book::find($id));
});

Route::get('/publishers', function(){
    return PublisherResource::collection(Publisher::all());
});

Route::get('/publisher/{id}', function($id){
    return new publisherResource(publisher::find($id));
});
Route::get('/authors', function(){
    return AuthorResource::collection(Author::all());
});
Route::get('/author/{id}', function($id){
    return new AuthorResource(Author::find($id));
});
Route::get('/categories', function(){
    return CategoryResource::collection(Category::all());
});
Route::get('/category/{id}', function($id){
    return new CategoryResource(Category::find($id));
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
