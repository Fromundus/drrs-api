<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Hamcrest\Core\IsNull;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function store(Request $request){
        $notification = Notification::create($request->all(), [
            "request_id" => $request->request_id,
            "title" => $request->title,
            "email" => $request->email,
            "message" => $request->message,
            "status" => $request->status
        ]);

        if($notification){
            return response()->json([
                "status" => "200",
                "data" => $notification
            ], 200);
        } else {
            return response()->json([
                "status" => "500",
                "message" => "Server Error"
            ], 500);
        }
    }

    public function storeMany(Request $request){
        $notifications = $request->all();

        foreach($notifications as $notif){
            Notification::create($notif);
        }
    }

    public function show($email){
        $notification = Notification::where("email", $email)->get();

        if($notification){
            return response()->json([
                "status" => "200",
                "data" => $notification
            ]);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ]);
        }
    }

    public function notifLength($email){
        $notification = Notification::where("email", $email)->where("status", "not seen")->get();

        if($notification){
            return response()->json([
                "status" => "200",
                "data" => $notification
            ]);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Not Found"
            ]);
        }
    }

    public function update($email){
        $notif = Notification::where("email", $email)->get();

        if($notif){
            $notif->each->update([
                "status" => "seen"
            ]);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "Notification Not Found!"
            ], 404);
        }
    }

    public function updateNotification(){
        $tomorrow = Carbon::tomorrow();

        $requests = ModelsRequest::where("pickup_date", $tomorrow)->get();

        foreach($requests as $request){
            if($request->clearance == "not" && $request->price == 0){
                if($request->admin_registrar == null){
                    $user = User::where("role", 2)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
            } else if ($request->clearance == "not" && $request->price > 0){
                if($request->admin_registrar == null){
                    $user = User::where("role", 2)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_cashier == null){
                    $user = User::where("role", 3)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
            } else if ($request->clearance == "required" && $request->price > 0){
                if($request->admin_registrar == null){
                    $user = User::where("role", 2)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_cashier == null){
                    $user = User::where("role", 3)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_library == null){
                    $user = User::where("role", 4)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_accounting_services == null){
                    $user = User::where("role", 5)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_student_services == null){
                    $user = User::where("role", 6)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_dorm == null){
                    $user = User::where("role", 7)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_dean == null){
                    $user = User::where("role", 8)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
            } else if ($request->clearance == "required" && $request->price == 0){
                if($request->admin_registrar == null){
                    $user = User::where("role", 2)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_library == null){
                    $user = User::where("role", 4)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_accounting_services == null){
                    $user = User::where("role", 5)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_student_services == null){
                    $user = User::where("role", 6)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_dorm == null){
                    $user = User::where("role", 7)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
                
                if ($request->admin_dean == null){
                    $user = User::where("role", 8)->first();

                    Notification::create([
                        "request_id" => $request->request_id,
                        "title" => "Pickup Reminder",
                        "email" => $user->email,
                        "message" => "Reminder! The document should be ready by tomorrow.",
                        "status" => "not seen"
                    ]);
                }
            }
        }

        if($requests->count() > 0){
            return response()->json([
                "status" => "200",
                "data" => $requests
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No requests found!"
            ], 404);
        }
    }

    public function getReminder(){
        $tomorrow = Carbon::tomorrow();

        $requests = ModelsRequest::where("pickup_date", $tomorrow)->get();

        if($requests->count() > 0){
            return response()->json([
                "status" => "200",
                "data" => $requests
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No requests found!"
            ], 404);
        }
    }

    public function getUserForReminder(Request $request){  
        $roleString = $request->query('roles');

        $roles = json_decode($roleString);
        
        $users = collect($roles)->map(function ($role) {
            return User::where("role", $role)->first();
        });

        if($users->count() > 0){
            return response()->json([
                "status" => "200",
                "data" => $users
            ], 200);
        } else {
            return response()->json([
                "status" => "404",
                "message" => "No users found!"
            ], 404);
        }
    }
}