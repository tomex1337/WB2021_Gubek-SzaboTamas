<?php

namespace App\Http\Controllers;

use App\Models\ingatlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngatlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingatlanok = Ingatlan::with('kategoria')->get();
        return response()->json($ingatlanok);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategoria' => 'required',
            'tehermentes' => 'required',
            'ar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Hiányos adatok'], 400);
        }
        $ingatlan = Ingatlan::create($request->all());
        return response()->json(['id'=>$ingatlan->id], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ingatlan $ingatlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ingatlan $ingatlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ingatlan = Ingatlan::where('id', '=', $id);
        if ($ingatlan->exists()) {
            $ingatlan->delete();
            return(response('', 204));
        }

        return response('Az ingatlan nem létezik.', 404);
    }
}
