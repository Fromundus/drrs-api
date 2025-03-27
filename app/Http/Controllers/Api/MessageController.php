<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "guest_id" => "required|string",
            "message" => "required|max:100|string",
            "role" => "required|string"
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "422",
                "message" => $validator->errors()
            ], 422);
        } else {
            $message = Message::create([
                "guest_id" => $request->guest_id,
                "message" => $request->message,
                "role" => $request->role
            ]);

            if($message){
                return response()->json([
                    "status" => "200",
                    "message" => "Message sent successfully!"
                ], 200);
            } else {
                return response()->json([
                    "status" => "500",
                    "message" => "Something went wrong!"
                ], 500);
            }
        }
    }

    public function index(){
        $message = Message::all();

        if($message->count() > 0){
            return response()->json([
                "status" => "200",
                "data" => $message
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No messages!"
            ], 404);
        }
    }

    public function show($guest_id){
        $message = Message::where("guest_id", $guest_id)->get();

        if($message->count() > 0){
            return response()->json([
                "status" => "200",
                "data" => $message
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Message not Found!"
            ], 404);
        }
    }
}
