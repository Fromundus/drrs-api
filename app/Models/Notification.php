<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'title',
        'message',
        'email',
        'status'
    ];

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
}
