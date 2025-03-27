<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        if($users){
            return response()->json([
                "status" => "200",
                "data" => $users
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Users not Found!"
            ], 404);
        }
    }

    public function userAccounts(){
        $users = User::where("role", 9)->get();

        if($users){
            return response()->json([
                "status" => "200",
                "data" => $users
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No users"
            ], 404);
        }
    }

    public function updateStatus($id, $status){
        $user = User::find($id);

        if($user){
            if($status === "active"){
                $user->update([
                    "status" => "active"
                ]);

                if($user){
                    $existing = Student::where("id_number", $user->id_number)->first();

                    if(!$existing){
                        Student::create([
                            "first_name" => $user->first_name,
                            "middle_name" => $user->middle_name,
                            "last_name" => $user->last_name,
                            "id_number" => $user->id_number,
                        ]);
                    }
                }

            } else if ($status === "inactive"){
                $user->update([
                    "status" => "inactive"
                ]);
            }

            return response()->json([
                "status" => "200",
                "message" => "User Status Updated Successfully"
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "User Not Found!"
            ], 404);
        }
    }

    public function updateStatusAndRole(Request $request, $id){
        $user = User::where("id", $id)->first();

        if($user){
            $validator = Validator::make($request->all(), [
                "role" => "required",
                "status" => "required"
            ]);

            if($validator->fails()){
                return response()->json([
                    "status" => "422",
                    "message" => $validator->errors()
                ], 422);
            } else {
                $user->update([
                    "role" => $request->role,
                    "status" => $request->status
                ]);

                if($user){
                    return response()->json([
                        "status" => "200",
                        "message" => "Updated successfully"
                    ], 200);
                } else {
                    return response()->json([
                        "status" => "500",
                        "message" => "Something went worng"
                    ], 500);
                }
            }
        }
    }

    public function show($id){
        $user = User::find($id);

        if($user){
            return response()->json([
                "status" => "200",
                "data" => $user
            ], 200); 
        } else {
            return response()->json([
                "status" => "404",
                "message" => "User Not Found!"
            ], 404);
        }
    }

    public function store(Request $request){
        if ($request->educational_status == "Undergraduate"){
            $validator = Validator::make($request->all(), [
                "first_name" => "required|string|min:3",
                "middle_name" => "required|string",
                "last_name" => "required|string|min:3",
                "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                "educational_status" => "required",
                "year_level" => "required",
                "email" => "required|email|unique:users,email",
                "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                "program" => "required|string",
                "college" => "required",
                "password" => "required|min:4|confirmed",
            ]);
        } else if ($request->educational_status == "Graduate"){
            $validator = Validator::make($request->all(), [
                "first_name" => "required|string|min:3",
                "middle_name" => "required|string",
                "last_name" => "required|string|min:3",
                "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                "educational_status" => "required",
                "last_year_attended_or_year_graduated" => "required|min:4|max:4",
                "email" => "required|email|unique:users,email",
                "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                "program" => "required|string",
                "college" => "required",
                "password" => "required|min:4|confirmed",
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                "first_name" => "required|string|min:3",
                "middle_name" => "required|string",
                "last_name" => "required|string|min:3",
                "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                "educational_status" => "required",
                "email" => "required|email|unique:users,email",
                "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                "program" => "required|string",
                "college" => "required",
                "password" => "required|min:4|confirmed",
            ]);
        }

        if($validator->fails()){
            return response()->json([
                "status" => "422",
                "message" => $validator->errors()
            ], 422);
        } else {
            $student = Student::where("id_number", $request->id_number)->first();

            if($student){
                if($student->last_name == $request->last_name){
                    $user = User::create([
                        "first_name" => $request->first_name,
                        "middle_name" => $request->middle_name,
                        "last_name" => $request->last_name,
                        "id_number" => $request->id_number,
                        "educational_status" => $request->educational_status,
                        "year_level" => $request->year_level,
                        "last_year_attended_or_year_graduated" => $request->last_year_attended_or_year_graduated,
                        "email" => $request->email,
                        "contact_number" => $request->contact_number,
                        "program" => $request->program,
                        "college" => $request->college,
                        "password" => Hash::make($request->password),
                        "role" => 9,
                        "status" => "active"
                    ]);
        
                    if($user){
                        return response()->json([
                            "status" => "200",
                            "message" => "User Created Successfully!"
                        ], 200);
                    } else {
                        return response()->json([
                            "status" => "500",
                            "message" => "Something Went Wrong"
                        ], 500);
                    }
                } else {
                    $user = User::create([
                        "first_name" => $request->first_name,
                        "middle_name" => $request->middle_name,
                        "last_name" => $request->last_name,
                        "id_number" => $request->id_number,
                        "educational_status" => $request->educational_status,
                        "year_level" => $request->year_level,
                        "last_year_attended_or_year_graduated" => $request->last_year_attended_or_year_graduated,
                        "email" => $request->email,
                        "contact_number" => $request->contact_number,
                        "program" => $request->program,
                        "college" => $request->college,
                        "password" => Hash::make($request->password),
                        "role" => 9,
                        "status" => "pending"
                    ]);
        
                    if($user){
                        return response()->json([
                            "status" => "200",
                            "message" => "User Created Successfully!"
                        ], 200);
                    } else {
                        return response()->json([
                            "status" => "500",
                            "message" => "Something Went Wrong"
                        ], 500);
                    }
                }
            } else {
                $user = User::create([
                    "first_name" => $request->first_name,
                    "middle_name" => $request->middle_name,
                    "last_name" => $request->last_name,
                    "id_number" => $request->id_number,
                    "educational_status" => $request->educational_status,
                    "year_level" => $request->year_level,
                    "last_year_attended_or_year_graduated" => $request->last_year_attended_or_year_graduated,
                    "email" => $request->email,
                    "contact_number" => $request->contact_number,
                    "program" => $request->program,
                    "college" => $request->college,
                    "password" => Hash::make($request->password),
                    "role" => 9,
                    "status" => "pending"
                ]);
    
                if($user){
                    return response()->json([
                        "status" => "200",
                        "message" => "User Created Successfully!"
                    ], 200);
                } else {
                    return response()->json([
                        "status" => "500",
                        "message" => "Something Went Wrong"
                    ], 500);
                }
            }
        }
    }

    public function changePassword(Request $request, $id){
        $user = User::where("id", $id)->first();

        if($user){
            $validator = Validator::make($request->all(), [
                "password" => "required|confirmed|min:4"
            ]);

            if($validator->fails()){
                return response()->json([
                    "status" => "422",
                    "message" => $validator->errors()
                ], 422);
            } else {
                $user->update([
                    "password" => Hash::make($request->password)
                ]);

                if($user){
                    return response()->json([
                        "status" => "200",
                        "message" => "Password Updated Successfully"
                    ], 200);
                } else {
                    return response()->json([
                        "status" => "500",
                        "message" => "Something Went Wrong"
                    ]);
                }
            }
        } else {
            return response()->json([
                "status" => "404",
                "message" => "User Not Found"
            ], 404);
        }
    }

    public function update(Request $request, $id, $educational_status){
        $user = User::where("id", $id)->first();

        if($user){
            if($educational_status == "Undergraduate"){
                if($request->email == $user->email && $request->id_number == $user->id_number && $request->contact_number == $user->contact_number){
                    $validator = Validator::make($request->except(["email", "id_number", "contact_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "educational_status" => "required",
                        "year_level" => "required",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else if ($request->email == $user->email && $request->id_number == $user->id_number){
                    $validator = Validator::make($request->except(["email", "id_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "educational_status" => "required",
                        "year_level" => "required",
                        "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else if ($request->email == $user->email && $request->contact_number == $user->contact_number){
                    $validator = Validator::make($request->except(["email", "contact_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                        "educational_status" => "required",
                        "year_level" => "required",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                }  else if ($request->contact_number == $user->contact_number && $request->id_number == $user->id_number){
                    $validator = Validator::make($request->except(["contact_number", "id_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "educational_status" => "required",
                        "year_level" => "required",
                        "email" => "required|email|unique:users,email",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else if ($request->email == $user->email){
                    $validator = Validator::make($request->except(["email"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                        "educational_status" => "required",
                        "year_level" => "required",
                        "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else if ($request->id_number == $user->id_number){
                    $validator = Validator::make($request->except(["id_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "educational_status" => "required",
                        "year_level" => "required",
                        "email" => "required|email|unique:users,email",
                        "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else if ($request->contact_number == $user->contact_number){
                    $validator = Validator::make($request->except(["contact_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                        "educational_status" => "required",
                        "year_level" => "required",
                        "email" => "required|email|unique:users,email",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                        "educational_status" => "required",
                        "year_level" => "required",
                        "email" => "required|email|unique:users,email",
                        "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                }

                if($validator->fails()){
                    return response()->json([
                        "status" => "422",
                        "message" => $validator->errors()
                    ], 422);
                } else {
                    $user->update([
                        "first_name" => $request->first_name,
                        "middle_name" => $request->middle_name,
                        "last_name" => $request->last_name,
                        "id_number" => $request->id_number,
                        "educational_status" => $request->educational_status,
                        "year_level" => $request->year_level,
                        "last_year_attended_or_year_graduated" => $request->last_year_attended_or_year_graduated,
                        "email" => $request->email,
                        "contact_number" => $request->contact_number,
                        "program" => $request->program,
                        "college" => $request->college
                    ]);
    
                    return response()->json([
                        "status" => "200",
                        "data" => $request->all()
                    ], 200);
                }
            } else if ($educational_status == "Graduate"){
                if($request->email == $user->email && $request->id_number == $user->id_number && $request->contact_number == $user->contact_number){
                    $validator = Validator::make($request->except(["email", "id_number", "contact_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "educational_status" => "required",
                        "last_year_attended_or_year_graduated" => "required|min:4|max:4",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else if ($request->email == $user->email && $request->id_number == $user->id_number){
                    $validator = Validator::make($request->except(["email", "id_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "educational_status" => "required",
                        "last_year_attended_or_year_graduated" => "required|min:4|max:4",
                        "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else if ($request->email == $user->email && $request->contact_number == $user->contact_number){
                    $validator = Validator::make($request->except(["email", "contact_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                        "educational_status" => "required",
                        "last_year_attended_or_year_graduated" => "required|min:4|max:4",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                }  else if ($request->contact_number == $user->contact_number && $request->id_number == $user->id_number){
                    $validator = Validator::make($request->except(["contact_number", "id_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "educational_status" => "required",
                        "last_year_attended_or_year_graduated" => "required|min:4|max:4",
                        "email" => "required|email|unique:users,email",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else if ($request->email == $user->email){
                    $validator = Validator::make($request->except(["email"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                        "educational_status" => "required",
                        "last_year_attended_or_year_graduated" => "required|min:4|max:4",
                        "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else if ($request->id_number == $user->id_number){
                    $validator = Validator::make($request->except(["id_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "educational_status" => "required",
                        "last_year_attended_or_year_graduated" => "required|min:4|max:4",
                        "email" => "required|email|unique:users,email",
                        "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else if ($request->contact_number == $user->contact_number){
                    $validator = Validator::make($request->except(["contact_number"]), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                        "educational_status" => "required",
                        "last_year_attended_or_year_graduated" => "required|min:4|max:4",
                        "email" => "required|email|unique:users,email",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        "first_name" => "required|string|min:3",
                        "middle_name" => "required|string",
                        "last_name" => "required|string|min:3",
                        "id_number" => "required|string|min:10|max:10|unique:users,id_number",
                        "educational_status" => "required",
                        "last_year_attended_or_year_graduated" => "required|min:4|max:4",
                        "email" => "required|email|unique:users,email",
                        "contact_number" => "required|min:10|max:10|unique:users,contact_number",
                        "program" => "required|string",
                        "college" => "required",
                    ]);
                }

                if($validator->fails()){
                    return response()->json([
                        "status" => "422",
                        "message" => $validator->errors()
                    ], 422);
                } else {
                    $user->update([
                        "first_name" => $request->first_name,
                        "middle_name" => $request->middle_name,
                        "last_name" => $request->last_name,
                        "id_number" => $request->id_number,
                        "educational_status" => $request->educational_status,
                        "year_level" => $request->year_level,
                        "last_year_attended_or_year_graduated" => $request->last_year_attended_or_year_graduated,
                        "email" => $request->email,
                        "contact_number" => $request->contact_number,
                        "program" => $request->program,
                        "college" => $request->college
                    ]);
    
                    return response()->json([
                        "status" => "200",
                        "data" => $request->all()
                    ], 200);
                }
            }

        } else {
            return response()->json([
                "status" => "200",
                "message" => "User not found!"
            ], 200);
        }
    }

    public function updateAdmin(Request $request, $id){
        $user = User::where("id", $id)->first();

        if($user){
            if($request->email == $user->email){
                $validator = Validator::make($request->except(["email"]), [
                    "first_name" => "required|string|min:3",
                    "middle_name" => "required|string",
                    "last_name" => "required|string|min:3",
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    "first_name" => "required|string|min:3",
                    "middle_name" => "required|string",
                    "last_name" => "required|string|min:3",
                    "email" => "required|email|unique:users,email",
                ]);
            }

            if($validator->fails()){
                return response()->json([
                    "status" => "422",
                    "message" => $validator->errors()
                ], 422);
            } else {
                $user->update([
                    "first_name" => $request->first_name,
                    "middle_name" => $request->middle_name,
                    "last_name" => $request->last_name,
                    "email" => $request->email,
                ]);

                return response()->json([
                    "status" => "200",
                    "data" => $request->all()
                ], 200);
            }

        } else {
            return response()->json([
                "status" => "200",
                "message" => "User not found!"
            ], 200);
        }
    }

    public function registrar(){
        $registrar = User::where("role", 2)->first();

        if($registrar){
            return response()->json([
                "status" => "200",
                "data" => $registrar
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No registrar"
            ], 404);
        }
    }

    public function dean($college){
        $dean = User::where("college", $college)->where("role", 8)->first();

        if($dean){
            return response()->json([
                "status" => "200",
                "data" => $dean
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No Dean"
            ], 404);
        }
    }

    public function uploadSignature(Request $request, $id){
        $user = User::where("id", $id)->first();

        if($user){
            $validator = Validator::make($request->all(), [
                "image" => "required|image|mimes:jpeg,png,jpg|max:2048"
            ]);

            if($validator->fails()){
                return response()->json([
                    "status" => "422",
                    "message" => $validator->errors()
                ], 422);
            } else {
                $image = $request->file("image");
                $imageName = '';

                if($user->role === 2){
                    $imageName = 'registrar.' . $image->extension();
                } else if ($user->role === 3){
                    $imageName = 'cashier.' . $image->extension();
                } else if ($user->role === 4){
                    $imageName = 'library.' . $image->extension();
                } else if ($user->role === 5){
                    $imageName = 'accountingservices.' . $image->extension();
                } else if ($user->role === 6){
                    $imageName = 'studentservices.' . $image->extension();
                } else if ($user->role === 7){
                    $imageName = 'dorm.' . $image->extension();
                } else if ($user->role === 8){
                    $imageName = $user->college . '.' . $image->extension();
                } else if ($user->role === 9){
                    $imageName = $user->id . '-' . $user->first_name . '.' . $image->extension();
                }

                $image->move(public_path('images'), $imageName);

                $user->update([
                    "e_signature" => $imageName,
                    "e_path" => 'images/'. $imageName
                ]);

                if($user){
                    return response()->json([
                        "status" => "200",
                        "data" => $user
                    ], 200);
                } else {
                    return response()->json([
                        "status" => "500",
                        "message" => "Something Went Wrong"
                    ], 500);
                }
                
                // $image = $request->file("image");
                // $imageName = time() . '.' . $image->extension();

                // $image->move(public_path('images'), $imageName);

                // $user->update([
                //     "e_signature" => $imageName,
                //     "e_path" => 'images/'. $imageName
                // ]);

                // if($user){
                //     return response()->json([
                //         "status" => "200",
                //         "data" => $user
                //     ], 200);
                // } else {
                //     return response()->json([
                //         "status" => "500",
                //         "message" => "Something Went Wrong"
                //     ], 500);
                // }
            }
        } else {
            return response()->json([
                "status" => "200",
                "message" => "User not found!"
            ], 200);
        }
    }

    public function getSignature($id){
        $user = User::where("id", $id)->first();

        if($user){
            $path = public_path('images/' . $user->e_signature);

            if(file_exists($path)){
                $file = file_get_contents($path);
                $type = mime_content_type($path);

                return response($file)->header('Content-Type', $type);
            } else {
                return response()->json([
                    "status" => "404",
                    "message" => "Signature not found"
                ], 404);
            }
        } else {
            return response()->json([
                "status" => "404",
                "message" => "User not found!"
            ], 404);
        }
    }

    public function getDeanSignature($college){
        $dean = User::where("college", $college)->where("role", 8)->first();

        if($dean){
            $path = public_path('images/' . $dean->e_signature);

            if(file_exists($path)){
                $file = file_get_contents($path);
                $type = mime_content_type($path);

                return response($file)->header('Content-Type', $type);
            } else {
                return response()->json([
                    "status" => "404",
                    "message" => "Signature not found"
                ], 404);
            }
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Dean not found!"
            ], 404);
        }
    }

    public function clearanceSignature($imageNames){
        $imageNames = json_decode($imageNames);
        $images = [];

        foreach($imageNames as $imageName){
            $path = public_path('images/'. $imageName);

            if(file_exists($path)){
                $file = file_get_contents($path);
                $type = mime_content_type($path);

                $images[] = [
                    'name' => $imageName,
                    'data' => base64_encode($file),
                    'type' => $type
                ];

                return response()->json(['images' => $images]);
            } else {
                return response()->json([
                    "status" => "404",
                    "message" => "Signature not found"
                ], 404);
            }
        }
    }

    public function getImages($imageNames){
        $imageNames = json_decode($imageNames);

        $images = [];

        foreach ($imageNames as $imageName) {
            $path = public_path('images/' . $imageName);

            if (file_exists($path)) {
                $file = file_get_contents($path);
                $type = mime_content_type($path);

                $images[] = [
                    'name' => $imageName,
                    'data' => base64_encode($file),
                    'type' => $type,
                ];
            }
        }

        return response()->json(['images' => $images]);
    }

    public function delete($id){
        $user = User::where("id", $id)->first();

        if($user){
            $user->delete();

            return response()->json([
                "status" => "200",
                "message" => "User deleted"
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "User not found"
            ], 404);
        }
    }
}