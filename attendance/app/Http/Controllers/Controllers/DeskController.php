<?php

namespace App\Http\Controllers;

use App\Http\Resources\Desk\DeskCollection;
use App\Http\Resources\Desk\DeskResource;
use App\Models\Desk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desks = Desk::all();
        if (is_null($desks) || count($desks) === 0) {
            return response()->json('No desks found!', 404);
        }
        return response()->json([
            'desks' => new DeskCollection($desks)
        ]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:desks',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $desk = Desk::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'Desk created' => new DeskResource($desk)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desk  $desk
     * @return \Illuminate\Http\Response
     */
    public function show($desk_id)
    {
        $desk = Desk::find($desk_id);
        if (is_null($desk)) {
            return response()->json('Desk not found', 404);
        }
        return response()->json([
            'desk' => new DeskResource($desk)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desk  $desk
     * @return \Illuminate\Http\Response
     */
    public function edit(Desk $desk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desk  $desk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desk $desk)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $desk->name = $request->name;
        $desk->save();

        return response()->json([
            'Desk updated' => new DeskResource($desk)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desk  $desk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desk $desk)
    {
        $desk->delete();
        return response()->json('Desk deleted');
    }
}
