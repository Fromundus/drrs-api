<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "service_code" => "required|string|unique:services,service_code",
            "name" => "required|string",
            "img" => "required|string",
            "clearance" => "required",
            "price" => "required",
            "processing_days" => "required",
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "422",
                "message" => $validator->errors()
            ], 422);
        } else {
            $service = Service::create([
                "service_code" => $request->service_code,
                "name" => $request->name,
                "img" => $request->img,
                "clearance" => $request->clearance,
                "price" => $request->price,
                "processing_days" => $request->processing_days,
            ]);
            
            if($service){
                return response()->json([
                    "status" => "200",
                    "messsage" => "Service created successfully"
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
        $services = Service::with("requirements")->get();

        if($services){
            return response()->json([
                "status" => "200",
                "data" => $services
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No Services"
            ], 404);
        }
    }

    public function show($id){
        $service = Service::where("id", $id)->with("requirements")->first();

        if($service){
            return response()->json([
                "status" => "200",
                "data" => $service
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "404 Not Found"
            ], 404);
        }
    }

    public function update(Request $request, $id){
        $service = Service::where("id", $id)->first();

        if($service){
            $validator = Validator::make($request->all(), [
                "service_code" => "required|string",
                "name" => "required|string",
                "img" => "required|string",
                "clearance" => "required",
                "price" => "required",
                "processing_days" => "required",
            ]);

            if($validator->fails()){
                return response()->json([
                    "status" => "422",
                    "message" => $validator->errors()
                ], 422);
            } else {
                $service->update([
                    "service_code" => $request->service_code,
                    "name" => $request->name,
                    "img" => $request->img,
                    "clearance" => $request->clearance,
                    "price" => $request->price,
                    "processing_days" => $request->processing_days,
                ]);

                return response()->json([
                    "status" => "200",
                    "message" => "Updated successfully"
                ], 200);
            }
        } else {
            return response()->json([
                "status" => "404",
                "message" => "404 Not Found"
            ], 404);
        }
    }

    public function destroy($id){
        $service = Service::where("id", $id)->first();

        if($service){
            $service->delete();

            return response()->json([
                "status" => "200",
                "message" => "Deleted successfully"
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Service not found"
            ], 404);
        }
    }
}
