<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class apiLivro extends Model
{
    protected $fillable = [
        'NomeLivro',
        'NomeAutor',
        'Editora',
    ];
}
