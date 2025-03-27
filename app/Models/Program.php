<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "program_code",
        "college_code"
    ];

    public function college(){
        return $this->belongsTo(College::class);
    }

    public function users(){
        return $this->hasMany(User::class, "program", "program_code");
    }
}
