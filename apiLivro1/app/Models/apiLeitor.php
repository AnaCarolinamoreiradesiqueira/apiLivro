<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class apiLeitor extends Model
{
    protected $fillable = [
        'NomeLeitor',
        'Idade',
        'Email',
    ];
}
