<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Relation For The Evaluation
    public function evaluation(){
        return $this-> hasMany(Evaluation::class);
    }
}
