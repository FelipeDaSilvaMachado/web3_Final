<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automoveis extends Model
{
    use HasFactory;

    protected $table = 'automoveis';
    protected $fillable = [
        'nome', 'marca', 'modelo', 'ano', 'cor', 'descricao',
    ];
}
