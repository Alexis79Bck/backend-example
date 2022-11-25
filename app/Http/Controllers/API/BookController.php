<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        /**
         * var $input almacena todos los request recibido en el http request
         */
        $input = $request->all();
        /**
         * var $validator recibe el resultado de la clase Validator
         * valida las entradas recibidas en el request.
         */
        $validator = Validator::make($input, [
            'title' => 'string|required|min:6',
            'npges' => 'numeric|required',
            'language' => 'required',
            'releaseYear' => 'numeric|required',
        ]);
        /**
         * Condicional en caso de que falle el validator, retorna los errores.
         */
        if ($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }
        /**
         * Crear el registro
         */
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
