<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        "guest_id"
    ];

    public function message(){
        return $this->hasMany(Message::class, "guest_id", "guest_id");
    }
}
