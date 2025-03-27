<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "request_id" => "required",
            "message" => "required:max:50|string",
            "from" => "required"
        ]);
        
        if($validator->fails()){
            return response()->json([
                "status" => "422",
                "message" => $validator->errors()
            ], 422);
        } else {
            $complaint = Complaint::create([
                "request_id" => $request->request_id,
                "message" => $request->message,
                "from" => $request->from,
            ]);
            
            if($complaint){
                return response()->json([
                    "status" => "200",
                    "messsage" => "Complaint created successfully"
                ], 200);
            } else {
                return response()->json([
                    "status" => "500",
                    "messsage" => "Something went wrong"
                ], 500);
            }
        }
    }

    public function index(){
        $complaint = Complaint::all();

        if($complaint){
            return response()->json([
                "status" => "200",
                "data" => $complaint
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No complaints"
            ], 404);
        }
    }

    public function show($request_id){
        $complaint = Complaint::where("request_id", $request_id)->get();

        if($complaint){
            return response()->json([
                "status" => "200",
                "data" => $complaint
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "404 Not Found"
            ], 404);
        }
    }
}
