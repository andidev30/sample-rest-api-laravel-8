<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $room = Room::all();
 
        return response()->json([
            "message" => "success",
            "data" => $room
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
        //
        $input = $request->all();
        $validator = Validator::make($input, [
        'room_name' => 'required',
        'room_capacity' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(), 422);      
        }
        
        $room = Room::create($input);

        return response()->json([
            "message" => "Room created successfully.",
            "data" => $room
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
        $room = Room::find($id);
        if (is_null($room)) {
            return response()->json($validator->errors(), 422);
        }
        return response()->json([
            "message" => "Room retrieved successfully.",
            "data" => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        //
        $input = $request->all();

        $validator = Validator::make($input, [
            'room_name' => 'required',
            'room_capacity' => 'required',
            'photo' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        
        $room->room_name = $input['room_name'];
        $room->room_capacity = $input['room_capacity'];
        $room->photo = $input['photo'];
        $room->save();
        
        return response()->json([
            "message" => "Rom updated successfully.",
            "data" => $room
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
        $room->delete();
        return response()->json([
            "message" => "room deleted successfully.",
            "data" => $room
        ]);
    }
}
