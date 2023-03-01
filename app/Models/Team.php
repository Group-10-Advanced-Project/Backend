<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];
    
    public function Employee(){
        return $this->hasMany(Employee::class);
    }

    public function Project(){
        return $this->hasMany(Project::class);
    }

}
