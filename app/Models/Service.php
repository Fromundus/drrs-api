<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_code',
        'name',
        'img',
        'clearance',
        'price',
        'processing_days',
    ];

    public function request(){
        return $this->hasMany(Request::class, 'document', 'name');
    }

    public function requirements(){
        return $this->hasMany(ServiceRequirement::class, 'service_code', 'service_code');
    }
}
