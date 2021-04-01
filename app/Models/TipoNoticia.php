<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoNoticia extends Model
{
    use softDeletes;

    protected $table = 'tipo_noticias';

    protected $fillable = [
        'nome', 'jornalista_id'
    ];

    public function noticias() {
        return $this->hasMany(Noticia::class);
    }

    public function jornalistas() {
        return $this->hasMany(Jornalista::class);
    }
}
