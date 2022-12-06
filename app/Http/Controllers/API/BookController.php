<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'string|required|min:6',
            'npages' => 'numeric|required',
            'language' => 'required',
            'releaseYear' => 'numeric|required',
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }

        $book = Book::create($input);
        return response()->json([
            'success' => true,
            'message' => 'The book have been registered successfully.',
            'book' => $book

        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($this->recordExists($id)){
            $book = Book::find($id);
            $book->title = $request->title ?? $book->title ;
            $book->npages = $request->npages ??  $book->npages;
            $book->language = $request->language ?? $book->language;
            $book->releaseYear = $request->releaseYear ?? $book->releaseYear;
            $book->author_id = $request->author_id ?? $book->author_id;
            $book->publisher_id = $request->publisher_id ?? $book->publisher_id;
            $book->category_id = $request->category_id ?? $book->category_id;
            $book->save();
            return response()->json([
                'success' => true,
                'message' => 'The book have been updated.',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "The book don't exist in our records.",
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ($this->recordExists($id)) {
            $book = Book::find($id);
            $book->delete();
            return response()->json([
                'success' => true,
                'message' => 'The book have been deleted.',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "The book don't exist in our records.",
            ], 404);
        }
    }
    /**
     *  Retorna true o false si el registro existe
     *
     * @param integer $id
     * @return boolean
     */
    private function recordExists(int $id): bool {
        return Book::where('id',$id)->exists();
    }
}
