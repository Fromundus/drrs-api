<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\GuestController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\RequestController;
use App\Http\Controllers\Api\RequirementController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServiceRequirementController;
use App\Http\Controllers\Api\UserController;
use App\Models\College;
use App\Models\Guest;
use App\Models\Program;
use App\Models\Request as ModelsRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//PROTECTED API 

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/useraccounts', [UserController::class, 'userAccounts']);
    Route::put('/userupdatestatus/{id}/{status}', [UserController::class, 'updateStatus']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/superadminuserupdate/{id}', [UserController::class, 'updateStatusAndRole']);
    Route::delete('deleteuser/{id}', [UserController::class, 'delete']);
    Route::put('/users/{id}/{educational_status}', [UserController::class, 'update']);
    Route::put('/updateadmin/{id}', [UserController::class, 'updateAdmin']);
    Route::put('/changepassword/{id}', [UserController::class, 'changePassword']);
    Route::get('/registrar', [UserController::class, 'registrar']);
    Route::get('/dean/{college}', [UserController::class, 'dean']);
    
    Route::post('/uploadesignature/{id}', [UserController::class, 'uploadSignature']);
    Route::get('/getsignature/{id}', [UserController::class, 'getSignature']);
    Route::get('/clearancesignature/{imageNames}', [UserController::class, 'clearanceSignature']);
    Route::get('/clearances/{imageNames}', [UserController::class, 'getImages']);
    Route::get('/deanSignature/{college}', [UserController::class, 'getDeanSignature']);

    Route::get('/requests', [RequestController::class, 'index']);

    Route::get('/getproof/{request_id}', [RequestController::class, 'getProof']);
    
    //REGISTRAR API
    Route::get('/approved', [RequestController::class, 'approved']);
    Route::get('/pending', [RequestController::class, 'pending']);
    Route::get('/topay', [RequestController::class, 'topay']);
    Route::get('/preparing', [RequestController::class, 'preparing']);
    Route::get('/onprocess', [RequestController::class, 'onprocess']);
    Route::get('/forpickup', [RequestController::class, 'forpickup']);
    Route::get('/latestrequests', [RequestController::class, 'latestRequest']);
    Route::put('/completerequest/{request_id}', [RequestController::class, 'completeRequest']);
    
    Route::post('/storeservices', [ServiceController::class, 'store']);
    Route::put('/updateservices/{id}', [ServiceController::class, 'update']);
    Route::delete('/deleteservices/{id}', [ServiceController::class, 'destroy']);

    Route::get('/getallcomplaints', [ComplaintController::class, 'index']);
    Route::post('/storecomplaint', [ComplaintController::class, 'store']);
    Route::get('/getcomplaint/{request_id}', [ComplaintController::class, 'show']);

    //CASHIER API
    Route::get('/priced', [RequestController::class, 'pricedRequests']);
    Route::get('/paid', [RequestController::class, 'paid']);
    Route::put('/releaseDocStamp/{request_id}', [RequestController::class, 'releaseDocStamp']);
    
    //LIBRARY API
    Route::get('/signedlibrary', [RequestController::class, 'libraryAdminSigned']);
    
    //ACCOUNTING SERVICES API
    Route::get('/signedaccountingservices', [RequestController::class, 'accountingServicesAdminSigned']);
    
    //STUDENT SERVICES API
    Route::get('/signedstudentservices', [RequestController::class, 'studentServicesAdminSigned']);
    
    //DORM API
    Route::get('/signeddorm', [RequestController::class, 'dormAdminSigned']);
    
    //DEAN API
    Route::get('/tobesignedbydean/{college}', [RequestController::class, 'forDean']);
    Route::get('/signeddean/{college}', [RequestController::class, 'deanAdminSigned']);
    
    Route::put('/request/update/{adminRole}/{request_id}/{status}', [RequestController::class, 'update']);
    Route::put('/acceptorrejectmanyrequests/{adminRole}/{status}', [RequestController::class, 'updateMany']);
    Route::delete('/request/delete/{id}', [RequestController::class, 'destroy']);
    
    Route::post('/notification', [NotificationController::class, 'store']);
    Route::get('/notification/{email}', [NotificationController::class, 'show']);
    Route::get('/notificationlength/{email}', [NotificationController::class, 'notifLength']);
    Route::put('/notification/{email}', [NotificationController::class, 'update']);
});

//PUBLIC API
Route::post('/storemanynotification', [NotificationController::class, 'storeMany']);

//REGISTER LOGIN
Route::post('/register', [UserController::class, 'store']);
// Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

//SERVICES
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{id}', [ServiceController::class, 'show']);

Route::get('/requirements', [RequirementController::class, 'index']);

Route::post('/serviceRequirement/{service_code}', [ServiceRequirementController::class, 'store']);
Route::get('/serviceRequirement/{service_code}', [ServiceRequirementController::class, 'show']);

//REQUESTS
Route::post('/request', [RequestController::class, 'store']);
// Route::post('/request/{clearance}/{educational_status}', [RequestController::class, 'storeEducRequest']);
Route::get('/request/progress/{request_id}', [RequestController::class, 'showProgress']);
Route::get('/requestbyid/{request_id}', [RequestController::class, 'showByID']);
Route::post('/uploadpaymentproof/{request_id}', [RequestController::class, 'uploadProof']);
Route::get('/request/{email}/{id_number}', [RequestController::class, 'show']);

//UPDATE NOTIFICATION
Route::post('updatenotification', [NotificationController::class, 'updateNotification']);
Route::get('getreminder', [NotificationController::class, 'getReminder']);
Route::get('getuserforreminder/by-roles', [NotificationController::class, 'getUserForReminder']);

//colleges/programs api
Route::get('/programs/{college_code}', [ProgramController::class, 'show']);
Route::get('/programs', [ProgramController::class, 'j']);

//GUEST API
Route::get('/guest', [GuestController::class, 'index']);
Route::post('/guest', [GuestController::class, 'store']);
Route::get('/guest/{guest_id}', [GuestController::class, 'show']);

//MESSAGE API
Route::get('/message', [MessageController::class, 'index']);
Route::post('/message', [MessageController::class, 'store']);
Route::get('/message/{guest_id}', [MessageController::class, 'show']);

Route::get('/allguestmessages', function() {
    $guestData = Guest::with("message")->get();

    if($guestData->count() > 0){
        return response()->json([
            "data" => $guestData
        ], 200);
    } else {
        return response()->json([
            "message" => "No Guests"
        ], 404);
    }
});

Route::get('/guestmessages/{guest_id}', function($guest_id) {
    $message = Guest::where("guest_id", $guest_id)->with("message")->get();

    if($message->count() > 0){
        return response()->json([
            "data" => $message
        ], 200);
    } else {
        return response()->json([
            "message" => "Guest Not Found!"
        ], 404);
    }
});

//test apis

Route::get('/userrequestsrelationship/{id}', function($id) {
    $userData = User::where("id", $id)
    ->with("notifications")
    ->get();

    if($userData->count() > 0){
        return response()->json([
            "data" => $userData
        ], 200);
    } else {
        return response()->json([
            "message" => "User not found"
        ], 404);
    }
});

Route::get('/colleges', function() {
    $colleges = College::with("programs")->get();

    if($colleges->count() > 0){
        return response()->json([
            "data" => $colleges
        ], 200);
    } else {
        return response()->json([
            "message" => "No Colleges"
        ], 404);
    }
});

Route::post('/student/{id_number}', function(Request $request, $id_number) {
    $student = Student::where("id_number", $id_number)->first();

    $validator = Validator::make($request->all(), [
        "last_name" => "required"
    ]);

    if($validator->fails()){
        return response()->json([
            "message" => $validator->errors()
        ], 422);
    } else {
        if($student){
            if($student->last_name == $request->last_name){
                return response()->json([
                    "data" => $student->last_name
                ], 200);
            } else {
                return response()->json([
                    "data" => "pending"
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "No student"
            ], 404);
        }
    }

});

Route::get('/requestswithmessages', function() {
    $docRequests = ModelsRequest::has("complaints")->get();

    if($docRequests){
        return response()->json([
            "data" => $docRequests
        ], 200);
    } else {
        return response()->json([
            "message" => "No Colleges"
        ], 404);
    }
});