<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentariosHq extends Model
{
    use HasFactory;
    protected $table = 'comentarioshq';

    protected $fillable = [
        'nome_historia',
        'id_historia',
        'email_comentarios',
        'conteudo_comentarios',
        'comic_id',
        'user_id'
    ];

}
