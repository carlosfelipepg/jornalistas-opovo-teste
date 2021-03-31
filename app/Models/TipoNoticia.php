<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoNoticia extends Model
{
    use softDeletes;

    protected $table = 'tipo_noticias';

    protected $fillable = [
        'nome'
    ];

    public function noticias() {
        return $this->hasMany(Noticia::class);
    }
}
