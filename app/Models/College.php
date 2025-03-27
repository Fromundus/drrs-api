<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "college_code"
    ];

    public function programs(){
        return $this->hasMany(Program::class, 'college_code', 'college_code');
    }
}
