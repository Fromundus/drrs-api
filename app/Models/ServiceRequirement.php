<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_code',
        'name',
        'requirement_code',
        'price',
        'quantity',
        'total_price'
    ];

    public function services(){
        return $this->belongsTo(Service::class);
    }

    public function requests(){
        return $this->belongsTo(Request::class);
    }
}
