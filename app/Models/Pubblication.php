<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pubblication extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_autore',
        'id_progetto',
        'titolo',
        'descrizione',
        'testo',
        'file_path',
    ];
}
