<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function store(Request $request){
        if($request->clearance == "required"){
            if ($request->educational_status == "Undergraduate"){
                $validator = Validator::make($request->all(), [
                    "request_id" => "required",
                    "document" => "required",
                    "service_code" => "required",
                    "first_name" => "required|string|min:3",
                    "middle_name" => "required|string|min:3",
                    "last_name" => "required|string|min:3",
                    "id_number" => "required|string|min:10|max:10",
                    "educational_status" => "required",
                    "year_level" => "required",
                    "email" => "required|email",
                    "contact_number" => "required|min:10|max:10",
                    "program" => "required|string",
                    "college" => "required",
                    "pickup_date" => "required",
                ]);
            } else if ($request->educational_status == "Graduate"){
                $validator = Validator::make($request->all(), [
                    "request_id" => "required",
                    "document" => "required",
                    "service_code" => "required",
                    "first_name" => "required|string|min:3",
                    "middle_name" => "required|string|min:3",
                    "last_name" => "required|string|min:3",
                    "id_number" => "required|string|min:10|max:10",
                    "educational_status" => "required",
                    "last_year_attended_or_year_graduated" => "required|min:4|max:4",
                    "email" => "required|email",
                    "contact_number" => "required|min:10|max:10",
                    "program" => "required|string",
                    "college" => "required",
                    "pickup_date" => "required",
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    "request_id" => "required",
                    "document" => "required",
                    "service_code" => "required",
                    "first_name" => "required|string|min:3",
                    "middle_name" => "required|string|min:3",
                    "last_name" => "required|string|min:3",
                    "id_number" => "required|string|min:10|max:10",
                    "educational_status" => "required",
                    "email" => "required|email",
                    "contact_number" => "required|min:10|max:10",
                    "program" => "required|string",
                    "college" => "required",
                    "pickup_date" => "required",
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
                    $docRequest = ModelsRequest::create([
                        "request_id" => $request->request_id,
                        "document" => $request->document,
                        "service_code" => $request->service_code,
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
                        "clearance" => $request->clearance,
                        "price" => $request->price,
                        "admin_registrar" => date("Y-m-d H:i:s"),
                        "status" => "on process",
                        "pickup_date" => Carbon::parse($request->pickup_date)->toDateTimeString(),
                    ]);

                    if($docRequest){
                        $documentRequest = ModelsRequest::where("request_id", $request->request_id)->first();

                        if(!is_null($request->file("picture_passport"))){
                            $picture_passport = $request->file("picture_passport");
                            $picture_passportName = $request->request_id . 'picture_passport' . '.' . $picture_passport->extension();

                            $picture_passport->move(public_path('images'), $picture_passportName);

                            $documentRequest->update([
                                'p' => $picture_passportName,
                                'picture_passport_path' => 'images/'. $picture_passportName,
                            ]);
                        }

                        if(!is_null($request->file("picture_2x2"))){
                            $picture_2x2 = $request->file("picture_2x2");
                            $picture_2x2Name = $request->request_id . 'picture_2x2' . '.' . $picture_2x2->extension();

                            $picture_2x2->move(public_path('images'), $picture_2x2Name);

                            $documentRequest->update([
                                'tbt' => $picture_2x2Name,
                                'picture_2x2_path' => 'images/'. $picture_2x2Name,
                            ]);
                        }
            
                        if(!is_null($request->file("affidavit_of_loss"))){
                            $affidavit_of_loss = $request->file("affidavit_of_loss");
                            $affidavit_of_lossName = $request->request_id . 'affidavit_of_loss' . '.' . $affidavit_of_loss->extension();

                            $affidavit_of_loss->move(public_path('images'), $affidavit_of_lossName);

                            $documentRequest->update([
                                'aol' => $affidavit_of_lossName,
                                'affidavit_of_loss_path' => 'images/'. $affidavit_of_lossName,
                            ]);
                        }
            
                        if(!is_null($request->file("psa_birth_certificate"))){
                            $psa_birth_certificate = $request->file("psa_birth_certificate");
                            $psa_birth_certificateName = $request->request_id . 'psa_birth_certificate' . '.' . $psa_birth_certificate->extension();

                            $psa_birth_certificate->move(public_path('images'), $psa_birth_certificateName);

                            $documentRequest->update([
                                'pbc' => $psa_birth_certificateName,
                                'psa_birth_certificate_path' => 'images/'. $psa_birth_certificateName,
                            ]);
                        }
            
                        if(!is_null($request->file("spa"))){
                            $spa = $request->file("spa");
                            $spaName = $request->request_id . 'spa' . '.' . $spa->extension();

                            $spa->move(public_path('images'), $spaName);

                            $documentRequest->update([
                                'spa' => $spaName,
                                'spa_path' => 'images/'. $spaName,
                            ]);
                        }
            
                        if(!is_null($request->file("authorization_letter_from_owner"))){
                            $authorization_letter_from_owner = $request->file("authorization_letter_from_owner");
                            $authorization_letter_from_ownerName = $request->request_id . 'authorization_letter_from_owner' . '.' . $authorization_letter_from_owner->extension();

                            $authorization_letter_from_owner->move(public_path('images'), $authorization_letter_from_ownerName);
                            
                            $documentRequest->update([
                                'alfo' => $authorization_letter_from_ownerName,
                                'authorization_letter_from_owner_path' => 'images/'. $authorization_letter_from_ownerName,
                            ]);
                        }
            
                        if(!is_null($request->file("valid_id_authorized_representative"))){
                            $valid_id_authorized_representative = $request->file("valid_id_authorized_representative");
                            $valid_id_authorized_representativeName = $request->request_id . 'valid_id_authorized_representative' . '.' . $valid_id_authorized_representative->extension();

                            $valid_id_authorized_representative->move(public_path('images'), $valid_id_authorized_representativeName);

                            $documentRequest->update([
                                'viar' => $valid_id_authorized_representativeName,
                                'valid_id_authorized_representative_path' => 'images/'. $valid_id_authorized_representativeName,
                            ]);
                        }

                        return response()->json([
                            "status" => "200",
                            "message" => "Request Sent"
                        ], 200);
                    } else {
                        return response()->json([
                            "status" => "500",
                            "message" => "Something Went Wrong!"
                        ], 500);
                    }
                } else {
                    $docRequest = ModelsRequest::create([
                        "request_id" => $request->request_id,
                        "document" => $request->document,
                        "service_code" => $request->service_code,
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
                        "clearance" => $request->clearance,
                        "price" => $request->price,
                        "status" => "pending",
                        "pickup_date" => Carbon::parse($request->pickup_date)->toDateTimeString(),
                    ]);

                    $documentRequest = ModelsRequest::where("request_id", $request->request_id)->first();

                    if(!is_null($request->file("picture_passport"))){
                        $picture_passport = $request->file("picture_passport");
                        $picture_passportName = $request->request_id . 'picture_passport' . '.' . $picture_passport->extension();

                        $picture_passport->move(public_path('images'), $picture_passportName);

                        $documentRequest->update([
                            'p' => $picture_passportName,
                            'picture_passport_path' => 'images/'. $picture_passportName,
                        ]);
                    }

                    if(!is_null($request->file("picture_2x2"))){
                        $picture_2x2 = $request->file("picture_2x2");
                        $picture_2x2Name = $request->request_id . 'picture_2x2' . '.' . $picture_2x2->extension();

                        $picture_2x2->move(public_path('images'), $picture_2x2Name);

                        $documentRequest->update([
                            'tbt' => $picture_2x2Name,
                            'picture_2x2_path' => 'images/'. $picture_2x2Name,
                        ]);
                    }
        
                    if(!is_null($request->file("affidavit_of_loss"))){
                        $affidavit_of_loss = $request->file("affidavit_of_loss");
                        $affidavit_of_lossName = $request->request_id . 'affidavit_of_loss' . '.' . $affidavit_of_loss->extension();

                        $affidavit_of_loss->move(public_path('images'), $affidavit_of_lossName);

                        $documentRequest->update([
                            'aol' => $affidavit_of_lossName,
                            'affidavit_of_loss_path' => 'images/'. $affidavit_of_lossName,
                        ]);
                    }
        
                    if(!is_null($request->file("psa_birth_certificate"))){
                        $psa_birth_certificate = $request->file("psa_birth_certificate");
                        $psa_birth_certificateName = $request->request_id . 'psa_birth_certificate' . '.' . $psa_birth_certificate->extension();

                        $psa_birth_certificate->move(public_path('images'), $psa_birth_certificateName);

                        $documentRequest->update([
                            'pbc' => $psa_birth_certificateName,
                            'psa_birth_certificate_path' => 'images/'. $psa_birth_certificateName,
                        ]);
                    }
        
                    if(!is_null($request->file("spa"))){
                        $spa = $request->file("spa");
                        $spaName = $request->request_id . 'spa' . '.' . $spa->extension();

                        $spa->move(public_path('images'), $spaName);

                        $documentRequest->update([
                            'spa' => $spaName,
                            'spa_path' => 'images/'. $spaName,
                        ]);
                    }
        
                    if(!is_null($request->file("authorization_letter_from_owner"))){
                        $authorization_letter_from_owner = $request->file("authorization_letter_from_owner");
                        $authorization_letter_from_ownerName = $request->request_id . 'authorization_letter_from_owner' . '.' . $authorization_letter_from_owner->extension();

                        $authorization_letter_from_owner->move(public_path('images'), $authorization_letter_from_ownerName);
                        
                        $documentRequest->update([
                            'alfo' => $authorization_letter_from_ownerName,
                            'authorization_letter_from_owner_path' => 'images/'. $authorization_letter_from_ownerName,
                        ]);
                    }
        
                    if(!is_null($request->file("valid_id_authorized_representative"))){
                        $valid_id_authorized_representative = $request->file("valid_id_authorized_representative");
                        $valid_id_authorized_representativeName = $request->request_id . 'valid_id_authorized_representative' . '.' . $valid_id_authorized_representative->extension();

                        $valid_id_authorized_representative->move(public_path('images'), $valid_id_authorized_representativeName);

                        $documentRequest->update([
                            'viar' => $valid_id_authorized_representativeName,
                            'valid_id_authorized_representative_path' => 'images/'. $valid_id_authorized_representativeName,
                        ]);
                    }
                }
            }

        } else if ($request->clearance === "not") {
            $validator = Validator::make($request->all(), [
                "request_id" => "required",
                "document" => "required",
                "service_code" => "required",
                "first_name" => "required|string|min:3",
                "middle_name" => "required|string|min:3",
                "last_name" => "required|string|min:3",
                "id_number" => "required|string|min:10|max:10",
                "email" => "required|email",
                "program" => "required|string",
                "college" => "required",
                "pickup_date" => "required",
            ]);

            if($validator->fails()){
                return response()->json([
                    "status" => "422",
                    "message" => $validator->errors()
                ], 422);
            } else {
                $student = Student::where("id_number", $request->id_number)->first();
    
                if($student){
                    if($request->price == 0){
                        $docRequest = ModelsRequest::create([
                            "request_id" => $request->request_id,
                            "document" => $request->document,
                            "service_code" => $request->service_code,
                            "first_name" => $request->first_name,
                            "middle_name" => $request->middle_name,
                            "last_name" => $request->last_name,
                            "id_number" => $request->id_number,
                            "email" => $request->email,
                            "program" => $request->program,
                            "college" => $request->college,
                            "clearance" => $request->clearance,
                            "price" => $request->price,
                            "admin_registrar" => date("Y-m-d H:i:s"),
                            "status" => "preparing",
                            "pickup_date" => Carbon::parse($request->pickup_date)->toDateTimeString(),
                        ]);
            
                        if($docRequest){
                            $documentRequest = ModelsRequest::where("request_id", $request->request_id)->first();

                            if(!is_null($request->file("picture_passport"))){
                                $picture_passport = $request->file("picture_passport");
                                $picture_passportName = $request->request_id . 'picture_passport' . '.' . $picture_passport->extension();

                                $picture_passport->move(public_path('images'), $picture_passportName);

                                $documentRequest->update([
                                    'p' => $picture_passportName,
                                    'picture_passport_path' => 'images/'. $picture_passportName,
                                ]);
                            }

                            if(!is_null($request->file("picture_2x2"))){
                                $picture_2x2 = $request->file("picture_2x2");
                                $picture_2x2Name = $request->request_id . 'picture_2x2' . '.' . $picture_2x2->extension();

                                $picture_2x2->move(public_path('images'), $picture_2x2Name);

                                $documentRequest->update([
                                    'tbt' => $picture_2x2Name,
                                    'picture_2x2_path' => 'images/'. $picture_2x2Name,
                                ]);
                            }
                
                            if(!is_null($request->file("affidavit_of_loss"))){
                                $affidavit_of_loss = $request->file("affidavit_of_loss");
                                $affidavit_of_lossName = $request->request_id . 'affidavit_of_loss' . '.' . $affidavit_of_loss->extension();

                                $affidavit_of_loss->move(public_path('images'), $affidavit_of_lossName);

                                $documentRequest->update([
                                    'aol' => $affidavit_of_lossName,
                                    'affidavit_of_loss_path' => 'images/'. $affidavit_of_lossName,
                                ]);
                            }
                
                            if(!is_null($request->file("psa_birth_certificate"))){
                                $psa_birth_certificate = $request->file("psa_birth_certificate");
                                $psa_birth_certificateName = $request->request_id . 'psa_birth_certificate' . '.' . $psa_birth_certificate->extension();

                                $psa_birth_certificate->move(public_path('images'), $psa_birth_certificateName);

                                $documentRequest->update([
                                    'pbc' => $psa_birth_certificateName,
                                    'psa_birth_certificate_path' => 'images/'. $psa_birth_certificateName,
                                ]);
                            }
                
                            if(!is_null($request->file("spa"))){
                                $spa = $request->file("spa");
                                $spaName = $request->request_id . 'spa' . '.' . $spa->extension();

                                $spa->move(public_path('images'), $spaName);

                                $documentRequest->update([
                                    'spa' => $spaName,
                                    'spa_path' => 'images/'. $spaName,
                                ]);
                            }
                
                            if(!is_null($request->file("authorization_letter_from_owner"))){
                                $authorization_letter_from_owner = $request->file("authorization_letter_from_owner");
                                $authorization_letter_from_ownerName = $request->request_id . 'authorization_letter_from_owner' . '.' . $authorization_letter_from_owner->extension();

                                $authorization_letter_from_owner->move(public_path('images'), $authorization_letter_from_ownerName);
                                
                                $documentRequest->update([
                                    'alfo' => $authorization_letter_from_ownerName,
                                    'authorization_letter_from_owner_path' => 'images/'. $authorization_letter_from_ownerName,
                                ]);
                            }
                
                            if(!is_null($request->file("valid_id_authorized_representative"))){
                                $valid_id_authorized_representative = $request->file("valid_id_authorized_representative");
                                $valid_id_authorized_representativeName = $request->request_id . 'valid_id_authorized_representative' . '.' . $valid_id_authorized_representative->extension();

                                $valid_id_authorized_representative->move(public_path('images'), $valid_id_authorized_representativeName);

                                $documentRequest->update([
                                    'viar' => $valid_id_authorized_representativeName,
                                    'valid_id_authorized_representative_path' => 'images/'. $valid_id_authorized_representativeName,
                                ]);
                            }

                            return response()->json([
                                "status" => "200",
                                "message" => "Request Sent"
                            ], 200);
                        } else {
                            return response()->json([
                                "status" => "500",
                                "message" => "Something Went Wrong!"
                            ], 500);
                        }
                    } else if ($request->price > 0){
                        $docRequest = ModelsRequest::create([
                            "request_id" => $request->request_id,
                            "document" => $request->document,
                            "service_code" => $request->service_code,
                            "first_name" => $request->first_name,
                            "middle_name" => $request->middle_name,
                            "last_name" => $request->last_name,
                            "id_number" => $request->id_number,
                            "email" => $request->email,
                            "program" => $request->program,
                            "college" => $request->college,
                            "clearance" => $request->clearance,
                            "price" => $request->price,
                            "admin_registrar" => date("Y-m-d H:i:s"),
                            "status" => "to pay",
                            "pickup_date" => Carbon::parse($request->pickup_date)->toDateTimeString(),
                        ]);
            
                        if($docRequest){
                            $documentRequest = ModelsRequest::where("request_id", $request->request_id)->first();

                            if(!is_null($request->file("picture_passport"))){
                                $picture_passport = $request->file("picture_passport");
                                $picture_passportName = $request->request_id . 'picture_passport' . '.' . $picture_passport->extension();

                                $picture_passport->move(public_path('images'), $picture_passportName);

                                $documentRequest->update([
                                    'p' => $picture_passportName,
                                    'picture_passport_path' => 'images/'. $picture_passportName,
                                ]);
                            }

                            if(!is_null($request->file("picture_2x2"))){
                                $picture_2x2 = $request->file("picture_2x2");
                                $picture_2x2Name = $request->request_id . 'picture_2x2' . '.' . $picture_2x2->extension();

                                $picture_2x2->move(public_path('images'), $picture_2x2Name);

                                $documentRequest->update([
                                    'tbt' => $picture_2x2Name,
                                    'picture_2x2_path' => 'images/'. $picture_2x2Name,
                                ]);
                            }
                
                            if(!is_null($request->file("affidavit_of_loss"))){
                                $affidavit_of_loss = $request->file("affidavit_of_loss");
                                $affidavit_of_lossName = $request->request_id . 'affidavit_of_loss' . '.' . $affidavit_of_loss->extension();

                                $affidavit_of_loss->move(public_path('images'), $affidavit_of_lossName);

                                $documentRequest->update([
                                    'aol' => $affidavit_of_lossName,
                                    'affidavit_of_loss_path' => 'images/'. $affidavit_of_lossName,
                                ]);
                            }
                
                            if(!is_null($request->file("psa_birth_certificate"))){
                                $psa_birth_certificate = $request->file("psa_birth_certificate");
                                $psa_birth_certificateName = $request->request_id . 'psa_birth_certificate' . '.' . $psa_birth_certificate->extension();

                                $psa_birth_certificate->move(public_path('images'), $psa_birth_certificateName);

                                $documentRequest->update([
                                    'pbc' => $psa_birth_certificateName,
                                    'psa_birth_certificate_path' => 'images/'. $psa_birth_certificateName,
                                ]);
                            }
                
                            if(!is_null($request->file("spa"))){
                                $spa = $request->file("spa");
                                $spaName = $request->request_id . 'spa' . '.' . $spa->extension();

                                $spa->move(public_path('images'), $spaName);

                                $documentRequest->update([
                                    'spa' => $spaName,
                                    'spa_path' => 'images/'. $spaName,
                                ]);
                            }
                
                            if(!is_null($request->file("authorization_letter_from_owner"))){
                                $authorization_letter_from_owner = $request->file("authorization_letter_from_owner");
                                $authorization_letter_from_ownerName = $request->request_id . 'authorization_letter_from_owner' . '.' . $authorization_letter_from_owner->extension();

                                $authorization_letter_from_owner->move(public_path('images'), $authorization_letter_from_ownerName);
                                
                                $documentRequest->update([
                                    'alfo' => $authorization_letter_from_ownerName,
                                    'authorization_letter_from_owner_path' => 'images/'. $authorization_letter_from_ownerName,
                                ]);
                            }
                
                            if(!is_null($request->file("valid_id_authorized_representative"))){
                                $valid_id_authorized_representative = $request->file("valid_id_authorized_representative");
                                $valid_id_authorized_representativeName = $request->request_id . 'valid_id_authorized_representative' . '.' . $valid_id_authorized_representative->extension();

                                $valid_id_authorized_representative->move(public_path('images'), $valid_id_authorized_representativeName);

                                $documentRequest->update([
                                    'viar' => $valid_id_authorized_representativeName,
                                    'valid_id_authorized_representative_path' => 'images/'. $valid_id_authorized_representativeName,
                                ]);
                            }

                            return response()->json([
                                "status" => "200",
                                "message" => "Request Sent"
                            ], 200);
                        } else {
                            return response()->json([
                                "status" => "500",
                                "message" => "Something Went Wrong!"
                            ], 500);
                        }
                    }
                } else {
                    $docRequest = ModelsRequest::create([
                        "request_id" => $request->request_id,
                        "document" => $request->document,
                        "service_code" => $request->service_code,
                        "first_name" => $request->first_name,
                        "middle_name" => $request->middle_name,
                        "last_name" => $request->last_name,
                        "id_number" => $request->id_number,
                        "email" => $request->email,
                        "program" => $request->program,
                        "college" => $request->college,
                        "clearance" => $request->clearance,
                        "price" => $request->price,
                        "status" => "pending",
                        "pickup_date" => Carbon::parse($request->pickup_date)->toDateTimeString(),
                    ]);
        
                    if($docRequest){
                        $documentRequest = ModelsRequest::where("request_id", $request->request_id)->first();

                        if(!is_null($request->file("picture_passport"))){
                            $picture_passport = $request->file("picture_passport");
                            $picture_passportName = $request->request_id . 'picture_passport' . '.' . $picture_passport->extension();

                            $picture_passport->move(public_path('images'), $picture_passportName);

                            $documentRequest->update([
                                'p' => $picture_passportName,
                                'picture_passport_path' => 'images/'. $picture_passportName,
                            ]);
                        }

                        if(!is_null($request->file("picture_2x2"))){
                            $picture_2x2 = $request->file("picture_2x2");
                            $picture_2x2Name = $request->request_id . 'picture_2x2' . '.' . $picture_2x2->extension();

                            $picture_2x2->move(public_path('images'), $picture_2x2Name);

                            $documentRequest->update([
                                'tbt' => $picture_2x2Name,
                                'picture_2x2_path' => 'images/'. $picture_2x2Name,
                            ]);
                        }
            
                        if(!is_null($request->file("affidavit_of_loss"))){
                            $affidavit_of_loss = $request->file("affidavit_of_loss");
                            $affidavit_of_lossName = $request->request_id . 'affidavit_of_loss' . '.' . $affidavit_of_loss->extension();

                            $affidavit_of_loss->move(public_path('images'), $affidavit_of_lossName);

                            $documentRequest->update([
                                'aol' => $affidavit_of_lossName,
                                'affidavit_of_loss_path' => 'images/'. $affidavit_of_lossName,
                            ]);
                        }
            
                        if(!is_null($request->file("psa_birth_certificate"))){
                            $psa_birth_certificate = $request->file("psa_birth_certificate");
                            $psa_birth_certificateName = $request->request_id . 'psa_birth_certificate' . '.' . $psa_birth_certificate->extension();

                            $psa_birth_certificate->move(public_path('images'), $psa_birth_certificateName);

                            $documentRequest->update([
                                'pbc' => $psa_birth_certificateName,
                                'psa_birth_certificate_path' => 'images/'. $psa_birth_certificateName,
                            ]);
                        }
            
                        if(!is_null($request->file("spa"))){
                            $spa = $request->file("spa");
                            $spaName = $request->request_id . 'spa' . '.' . $spa->extension();

                            $spa->move(public_path('images'), $spaName);

                            $documentRequest->update([
                                'spa' => $spaName,
                                'spa_path' => 'images/'. $spaName,
                            ]);
                        }
            
                        if(!is_null($request->file("authorization_letter_from_owner"))){
                            $authorization_letter_from_owner = $request->file("authorization_letter_from_owner");
                            $authorization_letter_from_ownerName = $request->request_id . 'authorization_letter_from_owner' . '.' . $authorization_letter_from_owner->extension();

                            $authorization_letter_from_owner->move(public_path('images'), $authorization_letter_from_ownerName);
                            
                            $documentRequest->update([
                                'alfo' => $authorization_letter_from_ownerName,
                                'authorization_letter_from_owner_path' => 'images/'. $authorization_letter_from_ownerName,
                            ]);
                        }
            
                        if(!is_null($request->file("valid_id_authorized_representative"))){
                            $valid_id_authorized_representative = $request->file("valid_id_authorized_representative");
                            $valid_id_authorized_representativeName = $request->request_id . 'valid_id_authorized_representative' . '.' . $valid_id_authorized_representative->extension();

                            $valid_id_authorized_representative->move(public_path('images'), $valid_id_authorized_representativeName);

                            $documentRequest->update([
                                'viar' => $valid_id_authorized_representativeName,
                                'valid_id_authorized_representative_path' => 'images/'. $valid_id_authorized_representativeName,
                            ]);
                        }

                        return response()->json([
                            "status" => "200",
                            "message" => "Request Sent"
                        ], 200);
                    } else {
                        return response()->json([
                            "status" => "500",
                            "message" => "Something Went Wrong!"
                        ], 500);
                    }
                }
            }
        }
    }

    public function destroy($id){
        $request = ModelsRequest::find($id);
        
        if($request){
            $request->delete();
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Request Not Found!"
            ], 404);
        }
    }

    public function index(){
        $requests = ModelsRequest::all();

        if($requests){
            return response()->json([
                "status" => "200",
                "data" => $requests
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No Requests"
            ], 404);
        }
    }

    public function latestRequest(){
        $requests = ModelsRequest::orderBy("created_at", "desc")->take(5)->get();

        if($requests){
            return response()->json([
                "status" => "200",
                "data" => $requests
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No Requests"
            ], 404);
        }
    }

    public function show($email, $id_number){
        $requests = ModelsRequest::where("email", $email)->where("id_number", $id_number)->get();

        if($requests){
            return response()->json([
                "status" => "200",
                "data" => $requests
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function showByID($request_id){
        $request = ModelsRequest::where("request_id", $request_id)->first();

        if($request){
            return response()->json([
                "status" => "200",
                "data" => $request
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function pending(){
        $pending = ModelsRequest::whereNull("admin_registrar")->get();

        if($pending){
            return response()->json([
                "status" => "200",
                "data" => $pending
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function approved(){
        $approved = ModelsRequest::whereNotNull("admin_registrar")->get();

        if($approved){
            return response()->json([
                "status" => "200",
                "data" => $approved
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function preparing(){
        $preparing = ModelsRequest::where("status", "preparing")->get();

        if($preparing){
            return response()->json([
                "status" => "200",
                "data" => $preparing
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function topay(){
        $topay = ModelsRequest::where("status", "to pay")->get();

        if($topay){
            return response()->json([
                "status" => "200",
                "data" => $topay
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function pricedRequests(){
        $priced = ModelsRequest::where("price", ">", "0")->get();

        if($priced){
            return response()->json([
                "status" => "200",
                "data" => $priced
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function paid(){
        $paid = ModelsRequest::whereNotNull("admin_cashier")->get();

        if($paid){
            return response()->json([
                "status" => "200",
                "data" => $paid
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function libraryAdminSigned(){
        $signed = ModelsRequest::whereNotNull("admin_library")->get();

        if($signed){
            return response()->json([
                "status" => "200",
                "data" => $signed
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function accountingServicesAdminSigned(){
        $signed = ModelsRequest::whereNotNull("admin_accounting_services")->get();

        if($signed){
            return response()->json([
                "status" => "200",
                "data" => $signed
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function studentServicesAdminSigned(){
        $signed = ModelsRequest::whereNotNull("admin_student_services")->get();

        if($signed){
            return response()->json([
                "status" => "200",
                "data" => $signed
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function dormAdminSigned(){
        $signed = ModelsRequest::whereNotNull("admin_dorm")->get();

        if($signed){
            return response()->json([
                "status" => "200",
                "data" => $signed
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function forDean($college){
        $requests = ModelsRequest::where("college", $college)->where("status", "on process")->get();

        if($requests){
            return response()->json([
                "status" => "200",
                "data" => $requests
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No requests"
            ], 404);
        }
    }

    public function deanAdminSigned($college){
        $signed = ModelsRequest::where("college", $college)->whereNotNull("admin_dean")->get();

        if($signed){
            return response()->json([
                "status" => "200",
                "data" => $signed
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function onprocess(){
        $onprocess = ModelsRequest::where("clearance", "required")->where("status", "on process")->whereNotNull("admin_registrar")->get();

        if($onprocess){
            return response()->json([
                "status" => "200",
                "data" => $onprocess
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function forpickup(){
        $forpickup = ModelsRequest::where("status", "for pickup")->get();

        if($forpickup){
            return response()->json([
                "status" => "200",
                "data" => $forpickup
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ], 404);
        }
    }

    public function showProgress($request_id){
        $request = ModelsRequest::where('request_id', $request_id)->with("serviceRequirements")->with("complaints")->first();

        if($request){
            if($request->clearance == "required" && $request->price > 0){
                $approved_array = array();
                if($request->admin_registrar){
                    $admin_registrar_object = new \stdClass();
                    $admin_registrar_object->date = $request->admin_registrar;
                    $admin_registrar_object->name = "admin_registrar";
                    $admin_registrar_object->status_message = "Approved by the Registrar.";

                    $clearance_created = new \stdClass();
                    $clearance_created->date = $request->admin_registrar;
                    $clearance_created->name = "clearance_created";
                    $clearance_created->status_message = "Digital clearance created.";
    
                    array_push($approved_array, $clearance_created);
                    array_push($approved_array, $admin_registrar_object);
                }
    
                if($request->admin_cashier){
                    $admin_cashier_object = new \stdClass();
                    $admin_cashier_object->date = $request->admin_cashier;
                    $admin_cashier_object->name = "admin_cashier";
                    $admin_cashier_object->status_message = "Approved by the Cashier.";

                    array_push($approved_array, $admin_cashier_object);
                }
    
                if($request->admin_library){
                    $admin_library_object = new \stdClass();
                    $admin_library_object->date = $request->admin_library;
                    $admin_library_object->name = "admin_library";
                    $admin_library_object->status_message = "Approved by the Librarian.";
    
                    array_push($approved_array, $admin_library_object);
                }
    
                if($request->admin_accounting_services){
                    $admin_accounting_services_object = new \stdClass();
                    $admin_accounting_services_object->date = $request->admin_accounting_services;
                    $admin_accounting_services_object->name = "admin_accounting_services";
                    $admin_accounting_services_object->status_message = "Approved by the Accounting Services.";
    
                    array_push($approved_array, $admin_accounting_services_object);
                }
    
                if($request->admin_student_services){
                    $admin_student_services_object = new \stdClass();
                    $admin_student_services_object->date = $request->admin_student_services;
                    $admin_student_services_object->name = "admin_student_services";
                    $admin_student_services_object->status_message = "Approved by the Student Services.";
    
                    array_push($approved_array, $admin_student_services_object);
                }
    
                if($request->admin_dorm){
                    $admin_dorm_object = new \stdClass();
                    $admin_dorm_object->date = $request->admin_dorm;
                    $admin_dorm_object->name = "admin_dorm";
                    $admin_dorm_object->status_message = "Approved by the Dorm Admin.";
    
                    array_push($approved_array, $admin_dorm_object);
                }
    
                if($request->admin_dean){
                    $admin_dean_object = new \stdClass();
                    $admin_dean_object->date = $request->admin_dean;
                    $admin_dean_object->name = "admin_dean";
                    $admin_dean_object->status_message = "Approved by the Dean.";
    
                    array_push($approved_array, $admin_dean_object);
                }

                if($request->for_pickup){
                    $for_pickup_object = new \stdClass();
                    $for_pickup_object->date = $request->for_pickup;
                    $for_pickup_object->name = "for_pickup";
                    $for_pickup_object->status_message = "Your Document is ready for pick up.";
    
                    array_push($approved_array, $for_pickup_object);
                }

                if($request->rejected){
                    $rejected_object = new \stdClass();
                    $rejected_object->date = $request->rejected;
                    $rejected_object->name = "rejected";
                    $rejected_object->status_message = $request->remarks;
    
                    array_push($approved_array, $rejected_object);
                }

            } else if ($request->clearance == "not" && $request->price == 0) {
                $approved_array = array();
                if($request->admin_registrar){
                    $admin_registrar_object = new \stdClass();
                    $admin_registrar_object->date = $request->admin_registrar;
                    $admin_registrar_object->name = "admin_registrar";
                    $admin_registrar_object->status_message = "Approved by the Registrar.";
    
                    array_push($approved_array, $admin_registrar_object);
                }

                if($request->for_pickup){
                    $for_pickup_object = new \stdClass();
                    $for_pickup_object->date = $request->for_pickup;
                    $for_pickup_object->name = "for_pickup";
                    $for_pickup_object->status_message = "Your Document is ready for pick up.";
    
                    array_push($approved_array, $for_pickup_object);
                }

                if($request->rejected){
                    $rejected_object = new \stdClass();
                    $rejected_object->date = $request->rejected;
                    $rejected_object->name = "rejected";
                    $rejected_object->status_message = $request->remarks;
    
                    array_push($approved_array, $rejected_object);
                }

            } else if ($request->clearance == "required" && $request->price == 0){
                $approved_array = array();
                if($request->admin_registrar){
                    $admin_registrar_object = new \stdClass();
                    $admin_registrar_object->date = $request->admin_registrar;
                    $admin_registrar_object->name = "admin_registrar";
                    $admin_registrar_object->status_message = "Approved by the Registrar.";

                    $clearance_created = new \stdClass();
                    $clearance_created->date = $request->admin_registrar;
                    $clearance_created->name = "clearance_created";
                    $clearance_created->status_message = "Digital clearance created.";

                    array_push($approved_array, $clearance_created);
                    array_push($approved_array, $admin_registrar_object);
                }

                if($request->admin_library){
                    $admin_library_object = new \stdClass();
                    $admin_library_object->date = $request->admin_library;
                    $admin_library_object->name = "admin_library";
                    $admin_library_object->status_message = "Approved by the Librarian.";
    
                    array_push($approved_array, $admin_library_object);
                }
    
                if($request->admin_accounting_services){
                    $admin_accounting_services_object = new \stdClass();
                    $admin_accounting_services_object->date = $request->admin_accounting_services;
                    $admin_accounting_services_object->name = "admin_accounting_services";
                    $admin_accounting_services_object->status_message = "Approved by the Accounting Services.";
    
                    array_push($approved_array, $admin_accounting_services_object);
                }
    
                if($request->admin_student_services){
                    $admin_student_services_object = new \stdClass();
                    $admin_student_services_object->date = $request->admin_student_services;
                    $admin_student_services_object->name = "admin_student_services";
                    $admin_student_services_object->status_message = "Approved by the Student Services.";
    
                    array_push($approved_array, $admin_student_services_object);
                }
    
                if($request->admin_dorm){
                    $admin_dorm_object = new \stdClass();
                    $admin_dorm_object->date = $request->admin_dorm;
                    $admin_dorm_object->name = "admin_dorm";
                    $admin_dorm_object->status_message = "Approved by the Dorm Admin.";
    
                    array_push($approved_array, $admin_dorm_object);
                }
    
                if($request->admin_dean){
                    $admin_dean_object = new \stdClass();
                    $admin_dean_object->date = $request->admin_dean;
                    $admin_dean_object->name = "admin_dean";
                    $admin_dean_object->status_message = "Approved by the Dean.";
    
                    array_push($approved_array, $admin_dean_object);
                }

                if($request->for_pickup){
                    $for_pickup_object = new \stdClass();
                    $for_pickup_object->date = $request->for_pickup;
                    $for_pickup_object->name = "for_pickup";
                    $for_pickup_object->status_message = "Your Document is ready for pick up.";
    
                    array_push($approved_array, $for_pickup_object);
                }

                if($request->rejected){
                    $rejected_object = new \stdClass();
                    $rejected_object->date = $request->rejected;
                    $rejected_object->name = "rejected";
                    $rejected_object->status_message = $request->remarks;
    
                    array_push($approved_array, $rejected_object);
                }

            } else if($request->clearance == "not" && $request->price > 0){
                $approved_array = array();
                if($request->admin_registrar){
                    $admin_registrar_object = new \stdClass();
                    $admin_registrar_object->date = $request->admin_registrar;
                    $admin_registrar_object->name = "admin_registrar";
                    $admin_registrar_object->status_message = "Approved by the Registrar.";
    
                    array_push($approved_array, $admin_registrar_object);
                }
    
                if($request->admin_cashier){
                    $admin_cashier_object = new \stdClass();
                    $admin_cashier_object->date = $request->admin_cashier;
                    $admin_cashier_object->name = "admin_cashier";
                    $admin_cashier_object->status_message = "Approved by the Cashier.";
    
                    array_push($approved_array, $admin_cashier_object);
                }

                if($request->for_pickup){
                    $for_pickup_object = new \stdClass();
                    $for_pickup_object->date = $request->for_pickup;
                    $for_pickup_object->name = "for_pickup";
                    $for_pickup_object->status_message = "Your Document is ready for pick up.";
    
                    array_push($approved_array, $for_pickup_object);
                }

                if($request->rejected){
                    $rejected_object = new \stdClass();
                    $rejected_object->date = $request->rejected;
                    $rejected_object->name = "rejected";
                    $rejected_object->status_message = $request->remarks;
    
                    array_push($approved_array, $rejected_object);
                }
            }

            return response()->json([
                "status" => "200",
                "data" => $request,
                "approved_array" => $approved_array
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Request Not Found!"
            ], 404);
        }
    }

    public function update($adminRole, $request_id, $status ){
        $request = ModelsRequest::where("request_id", $request_id)->first();
        
        if($request){
            if($adminRole == "registrarAdmin"){
                if($request->admin_registrar == null){
                    if($status == "accept"){
                        if($request->price == 0 && $request->clearance == "not"){
                            $request->update([
                                "admin_registrar" => date("Y-m-d H:i:s"),
                                "status" => "preparing"
                            ]);
                        } else if($request->price == 0 && $request->clearance == "required") {
                            $request->update([
                                "admin_registrar" => date("Y-m-d H:i:s"),
                                "status" => "on process"
                            ]);
                        } else if($request->price > 0 && $request->clearance == "required"){
                            $request->update([
                                "admin_registrar" => date("Y-m-d H:i:s"),
                                "status" => "on process"
                            ]);
                        } else if($request->price > 0 && $request->clearance == "not"){
                            $request->update([
                                "admin_registrar" => date("Y-m-d H:i:s"),
                                "status" => "to pay"
                            ]);
                        }
                    } else if ($status == "reject"){
                        $request->update([
                            "rejected" => date("Y-m-d H:i:s"),
                            "remarks" => "Rejected by Registrar Admin.",
                            "status" => "rejected"
                        ]);
                    }
                } else {
                    $request->update([
                        "for_pickup" => date("Y-m-d H:i:s"),
                        "status" => "for pickup"
                    ]);
                }
            } else if ($adminRole == "cashierAdmin"){
                if($status === "accept"){
                    if($request->clearance == "required"){
                        $request->update([
                            "admin_cashier" => date("Y-m-d H:i:s"),
                            "status" => "preparing"
                        ]);
                    } else if($request->clearance == "not"){
                        $request->update([
                            "admin_cashier" => date("Y-m-d H:i:s"),
                            "status" => "preparing"
                        ]);
                    }
                } else if ($status == "reject"){
                    $request->update([
                        "rejected" => date("Y-m-d H:i:s"),
                        "remarks" => "Rejected by Cashier Admin.",
                        "status" => "rejected"
                    ]);
                }
            } else if ($adminRole == "libraryAdmin"){
                if($status == "accept"){
                    $request->update([
                        "admin_library" => date("Y-m-d H:i:s"),
                        "status" => "on process"
                    ]);
                } else if ($status == "reject"){
                    $request->update([
                        "rejected" => date("Y-m-d H:i:s"),
                        "remarks" => "Rejected by Library Admin.",
                        "status" => "rejected"
                    ]);
                }
            } else if ($adminRole == "accountingServicesAdmin"){
                if($status == "accept"){
                    $request->update([
                        "admin_accounting_services" => date("Y-m-d H:i:s"),
                        "status" => "on process"
                    ]);
                } else if ($status == "reject"){
                    $request->update([
                        "rejected" => date("Y-m-d H:i:s"),
                        "remarks" => "Rejected by Accounting Services Admin.",
                        "status" => "rejected"
                    ]);
                }
            } else if ($adminRole == "studentServicesAdmin"){
                if($status == "accept"){
                    $request->update([
                        "admin_student_services" => date("Y-m-d H:i:s"),
                        "status" => "on process"
                    ]);
                } else if ($status == "reject"){
                    $request->update([
                        "rejected" => date("Y-m-d H:i:s"),
                        "remarks" => "Rejected by Student Services Admin.",
                        "status" => "rejected"
                    ]);
                }
            } else if ($adminRole == "dormAdmin"){
                if($status == "accept"){
                    $request->update([
                        "admin_dorm" => date("Y-m-d H:i:s"),
                        "status" => "on process"
                    ]);
                } else if ($status == "reject"){
                    $request->update([
                        "rejected" => date("Y-m-d H:i:s"),
                        "remarks" => "Rejected by Dorm Admin.",
                        "status" => "rejected"
                    ]);
                }
            } else if ($adminRole == "deanAdmin"){
                if($status == "accept"){
                    if($request->price > 0){
                        $request->update([
                            "admin_dean" => date("Y-m-d H:i:s"),
                            "status" => "to pay"
                        ]);
                    } else if($request->price == 0) {
                        $request->update([
                            "admin_dean" => date("Y-m-d H:i:s"),
                            "status" => "preparing"
                        ]);
                    }
                } else if ($status == "reject"){
                    $request->update([
                        "rejected" => date("Y-m-d H:i:s"),
                        "remarks" => "Rejected by Dean.",
                        "status" => "rejected"
                    ]);
                }
            }

        } else {
            return response()->json([
                "status" => "404",
                "message" => "Request Not Found!"
            ], 404);
        }
    }

    public function updateMany(Request $request, $adminRole, $status){
        $request_ids = $request->all();
    
        foreach($request_ids as $request_id){
            $userRequest = ModelsRequest::where("request_id", $request_id)->first();

            if($userRequest){
                if($adminRole == "registrarAdmin"){
                    if($status == "accept"){
                        if($userRequest->price == 0 && $userRequest->clearance == "not"){
                            $userRequest->update([
                                "admin_registrar" => date("Y-m-d H:i:s"),
                                "status" => "preparing"
                            ]);
                        } else if($userRequest->price == 0 && $userRequest->clearance == "required") {
                            $userRequest->update([
                                "admin_registrar" => date("Y-m-d H:i:s"),
                                "status" => "on process"
                            ]);
                        } else if($userRequest->price > 0 && $userRequest->clearance == "required"){
                            $userRequest->update([
                                "admin_registrar" => date("Y-m-d H:i:s"),
                                "status" => "on process"
                            ]);
                        } else if($userRequest->price > 0 && $userRequest->clearance == "not"){
                            $userRequest->update([
                                "admin_registrar" => date("Y-m-d H:i:s"),
                                "status" => "to pay"
                            ]);
                        }
                    } else if ($status == "reject"){
                        $userRequest->update([
                            "rejected" => date("Y-m-d H:i:s"),
                            "remarks" => "Rejected by Registrar Admin.",
                            "status" => "rejected"
                        ]);
                    }
                } else if ($adminRole == "libraryAdmin"){
                    if($status == "accept"){
                        $userRequest->update([
                            "admin_library" => date("Y-m-d H:i:s"),
                            "status" => "on process"
                        ]);
                    } else if ($status == "reject"){
                        $userRequest->update([
                            "rejected" => date("Y-m-d H:i:s"),
                            "remarks" => "Rejected by Library Admin.",
                            "status" => "rejected"
                        ]);
                    }
                } else if ($adminRole == "accountingServicesAdmin"){
                    if($status == "accept"){
                        $userRequest->update([
                            "admin_accounting_services" => date("Y-m-d H:i:s"),
                            "status" => "on process"
                        ]);
                    } else if ($status == "reject"){
                        $userRequest->update([
                            "rejected" => date("Y-m-d H:i:s"),
                            "remarks" => "Rejected by Accounting Services Admin.",
                            "status" => "rejected"
                        ]);
                    }
                } else if ($adminRole == "studentServicesAdmin"){
                    if($status == "accept"){
                        $userRequest->update([
                            "admin_student_services" => date("Y-m-d H:i:s"),
                            "status" => "on process"
                        ]);
                    } else if ($status == "reject"){
                        $userRequest->update([
                            "rejected" => date("Y-m-d H:i:s"),
                            "remarks" => "Rejected by Student Services Admin.",
                            "status" => "rejected"
                        ]);
                    }
                } else if ($adminRole == "dormAdmin"){
                    if($status == "accept"){
                        $userRequest->update([
                            "admin_dorm" => date("Y-m-d H:i:s"),
                            "status" => "on process"
                        ]);
                    } else if ($status == "reject"){
                        $userRequest->update([
                            "rejected" => date("Y-m-d H:i:s"),
                            "remarks" => "Rejected by Dorm Admin.",
                            "status" => "rejected"
                        ]);
                    }
                } else if ($adminRole == "deanAdmin"){
                    if($status == "accept"){
                        if($userRequest->price > 0){
                            $userRequest->update([
                                "admin_dean" => date("Y-m-d H:i:s"),
                                "status" => "to pay"
                            ]);
                        } else if($userRequest->price == 0) {
                            $userRequest->update([
                                "admin_dean" => date("Y-m-d H:i:s"),
                                "status" => "preparing"
                            ]);
                        }
                    } else if ($status == "reject"){
                        $userRequest->update([
                            "rejected" => date("Y-m-d H:i:s"),
                            "remarks" => "Rejected by Dean.",
                            "status" => "rejected"
                        ]);
                    }
                }
            }

        }
    }

    public function completeRequest($request_id){
        $request = ModelsRequest::where("request_id", $request_id)->first();

        if($request){
            $request->update([
                "status" => "completed",
                "completed" => date("Y-m-d H:i:s")
            ]);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Request not found"
            ], 404);
        }
    }

    public function uploadProof(Request $request, $request_id){
        $userRequest = ModelsRequest::where("request_id", $request_id)->first();
            
            if($userRequest){
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
                    $imageName = $request_id . 'payment-proof' . '.' . $image->extension();
    
                    $image->move(public_path('images'), $imageName);
    
                    $userRequest->update([
                        "proof" => $imageName,
                        "path_proof" => 'images/'. $imageName
                    ]);
    
                    if($userRequest){
                        return response()->json([
                            "status" => "200",
                            "data" => $userRequest
                        ], 200);
                    } else {
                        return response()->json([
                            "status" => "500",
                            "message" => "Something Went Wrong"
                        ], 500);
                    }
                }


            } else {
                return response()->json([
                    "status" => "404",
                    "message" => "Request not found"
                ], 404);
            }
    }

    public function getProof($request_id){
        $userRequest = ModelsRequest::where("request_id", $request_id)->first();

        if($userRequest){
            $path = public_path('images/' . $userRequest->proof);

            if(file_exists($path)){
                $file = file_get_contents($path);
                $type = mime_content_type($path);

                return response($file)->header('Content-Type', $type);
            } else {
                return response()->json([
                    "status" => "404",
                    "message" => "Proof not found"
                ], 404);
            }
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Request not found!"
            ], 404);
        }
    }

    public function releaseDocStamp($request_id){
        $documentRequest = ModelsRequest::where("request_id", $request_id)->first();

        if($documentRequest){
            $documentRequest->update([
                "document_stamp_release" => date("Y-m-d H:i:s")
            ]);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Request not found!"
            ], 404);
        }
    }
}
