<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
//     public function team(){
// return $this->belongsTo(Team::class);

//     }
protected $fillable = [
    'first_name',
    'email',
    'last_name',
    'phone_number',
    'employee_id',
];
}
