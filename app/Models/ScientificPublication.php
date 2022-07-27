<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScientificPublication extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ricercatore',
        'titolo',
        'descrizione',
        'testo',
        'fonte',
    ];
}
