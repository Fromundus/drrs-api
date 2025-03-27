<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    public function index(){
        $requirements = Requirement::all();

        if($requirements){
            return response()->json([
                "data" => $requirements
            ], 200);
        } else {
            return response()->json([
                "message" => "No requirements"
            ], 404);
        }
    }
}
