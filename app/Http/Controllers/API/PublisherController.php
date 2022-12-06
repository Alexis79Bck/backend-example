<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Publisher::all();
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
            'country' => 'string|required',
        ]);

        if ($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }

        $publisher = Publisher::create($input);
        return response()->json([
            'success' => true,
            'message' => 'The publisher have been registered successfully.',
            'publisher' => $publisher

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
        if ($this->recordExists($id)) {
            $publisher = Publisher::find($id);
            $publisher->name = $request->name;
            $publisher->save();
            return response()->json([
                'success' => true,
                'message' => 'The publisher have been updated.',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "The publisher don't exist in our records.",
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
            $publisher = Publisher::find($id);
            $publisher->delete();
            return response()->json([
                'success' => true,
                'message' => 'The publisher have been deleted.',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "The publisher don't exist in our records.",
            ], 404);
        }
    }
    /**
     * Retorna true o false si el registro existe
     *
     * @param integer $id
     * @return boolean
     */
    private function recordExists(int $id): bool {
        return Publisher::where('id',$id)->exists();
    }
}
