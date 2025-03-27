<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable =[
        'request_id',
        'document',
        'service_code',
        'first_name',
        'middle_name',
        'last_name',
        'id_number',
        'educational_status',
        'year_level',
        'last_year_attended_or_year_graduated',
        'email',
        'contact_number',
        'program',
        'college',
        'clearance',
        'price',
        'status',
        'for_pickup',
        'admin_registrar',
        'admin_cashier',
        'admin_library',
        'admin_accounting_services',
        'admin_student_services',
        'admin_dorm',
        'admin_dean',
        'rejected',
        'completed',
        'remarks',
        'pickup_date',
        'proof',
        'path_proof',
        
        'p',
        'picture_passport_path',

        'tbt',
        'picture_2x2_path',

        'aol',
        'affidavit_of_loss_path',

        'pbc',
        'psa_birth_certificate_path',

        'spa',
        'spa_path',

        'alfo',
        'authorization_letter_from_owner_path',

        'viar',
        'valid_id_authorized_representative_path',

        'document_stamp_release'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function complaints(){
        return $this->hasMany(Complaint::class, 'request_id', 'request_id');
    }

    public function serviceRequirements(){
        return $this->hasMany(ServiceRequirement::class, 'service_code', 'service_code');
    }

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
}
