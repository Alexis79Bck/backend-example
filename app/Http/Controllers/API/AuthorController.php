<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Author::all();
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
            'name' => 'string|required|min:6',
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }

        $author = Author::create($input);
        return response()->json([
            'success' => true,
            'message' => 'The author have been registered successfully.',
            'author' => $author

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
        return Author::findOrFail($id);
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
        if ($this->recordExists($id)) {
            $author = Author::find($id);
            $author->name = $request->name;
            $author->save();
            return response()->json([
                'success' => true,
                'message' => 'The author have been updated.',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "The author don't exist in our records.",
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
            $author = Author::find($id);
            $author->delete();
            return response()->json([
                'success' => true,
                'message' => 'The author have been deleted.',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "The author don't exist in our records.",
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
        return Author::where('id',$id)->exists();
    }
}
