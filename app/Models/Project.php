<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'about',
        'status',
        
    ];
    public function Team(){
        return $this->belongsTo(Team::class);
    }
}
