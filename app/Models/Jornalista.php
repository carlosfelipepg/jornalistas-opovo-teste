<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Jornalista extends Model implements JWTSubject
{
    protected $table = 'jornalistas';

    protected $fillable = [
        'nome', 'sobrenome', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }   

    public function noticias() {
        return $this->hasMany(Noticia::class);
    }

}
