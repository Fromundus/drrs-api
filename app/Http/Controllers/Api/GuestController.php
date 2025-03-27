<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "guest_id" => "required|string"
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "422",
                "message" => $validator->errors()
            ], 422);
        } else {
            $guest = Guest::create([
                "guest_id" => $request->guest_id
            ]);
            
            if($guest){
                return response()->json([
                    "status" => "200",
                    "message" => "Guest User created successfully"
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
        $guest = Guest::all();

        if($guest->count() > 0){
            return response()->json([
                "status" => "200",
                "data" => $guest
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No Guest Users"
            ], 404);
        }
    }

    public function show($guest_id){
        $guest = Guest::where("guest_id", $guest_id)->get();

        if($guest->count() > 0){
            return response()->json([
                "status" => "200",
                "data" => $guest
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Guest user not found!"
            ]); 
        }
    }
}