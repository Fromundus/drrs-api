<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        "guest_id",
        "message",
        "role"
    ];

    public function guest(){
        return $this->belongsTo(Guest::class);
    }
}
