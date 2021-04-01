<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoNoticia extends Model
{
    protected $table = 'tipo_noticias';

    protected $fillable = [
        'nome', 'jornalista_id'
    ];

    public function noticias() {
        return $this->hasMany(Noticia::class);
    }

    public function jornalista() {
        return $this->belongsTo(Jornalista::class);
    }
}
