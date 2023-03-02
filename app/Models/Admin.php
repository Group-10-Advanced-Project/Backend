<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Admin extends Authenticatable implements JWTSubject 
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
 
    public function getJWTCustomClaims() { 
         return [];
    }
    
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
}
