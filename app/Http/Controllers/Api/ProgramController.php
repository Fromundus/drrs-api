<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function show($college_code){
        $programs = Program::where('college_code', $college_code)->get();

        if($programs->count() > 0){
            return response()->json([
                "data" => $programs
            ], 200);
        } else {
            return response()->json([
                "message" => "No programs"
            ], 404);
        }
    }

    public function j(){
        return response()->json([
            "message" => "Please select a college"
        ], 404);
    }
}
