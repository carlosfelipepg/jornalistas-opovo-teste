<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use softDeletes;

    protected $table = 'noticias';

    protected $fillable = [
        'titulo', 'descricao', 'corpo', 'imagem',
    ];

    public function jornalista() {
        return $this->belongsTo(Jornalista::class);
    }

    public function tipo_noticia() {
        return $this->belongsTo(TipoNoticia::class);
    }
}
