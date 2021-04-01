<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticia extends Model
{
    use softDeletes;

    protected $table = 'noticias';

    protected $fillable = [
        'titulo', 'descricao', 'corpo', 'imagem', 'jornalista_id', 'tipo_noticia_id',
    ];

    public function jornalista() {
        return $this->belongsTo(Jornalista::class);
    }

    public function tipo_noticia() {
        return $this->belongsTo(TipoNoticia::class);
    }
}
