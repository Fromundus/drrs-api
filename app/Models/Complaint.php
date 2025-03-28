<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'message',
        'from'
    ];

    public function request(){
        return $this->belongsTo(Request::class);
    }
}
