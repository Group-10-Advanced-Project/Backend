<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation',
        'evaluation_date',
    
    ];
    public function employees (){
        return $this-> belongsTo(Employee::class);
    }

    public function kpis (){
        return $this->belongsTo(Kpi::class);
    }
}
