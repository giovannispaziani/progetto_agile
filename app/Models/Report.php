<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ricercatore',
        'id_progetto',
        'titolo',
        'descrizione',
        'data',
        'file_path',
    ];
}
