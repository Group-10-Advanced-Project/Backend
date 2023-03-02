<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;


    //Relation For the Evaluation
    public function evaluation(){
        return $this-> hasMany(Evaluation::class);
    }

    protected $fillable = [
        'name',
        'about',
    ];


}
