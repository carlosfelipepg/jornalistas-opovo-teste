<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jornalista extends Model
{
    protected $table = 'jornalistas';

    protected $fillable = [
        'nome', 'sobrenome', 'email', 'password'
    ];

    protected $hidden = ['password'];

    public function noticias() {
        return $this->hasMany(Noticia::class);
    }

}
