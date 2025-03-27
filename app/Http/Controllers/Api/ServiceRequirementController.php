<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceRequirementController extends Controller
{
    public function show($service_code){
        $serviceRequirements = ServiceRequirement::where("service_code", $service_code)->get();

        if($serviceRequirements){
            return response()->json([
                "data" => $serviceRequirements
            ], 200);
        } else {
            return response()->json([
                "message" => "No requirements"
            ], 404);
        }
    }

    public function store(Request $request, $service_code){
        ServiceRequirement::where("service_code", $service_code)->delete();

        $serviceRequirements = $request->all();

        foreach($serviceRequirements as $serviceRequirement){
            ServiceRequirement::create($serviceRequirement);
        }
    }
}
