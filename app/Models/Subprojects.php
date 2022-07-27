<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subprojects extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_responsabile',
        'id_progetto',
        'titolo',
        'descrizione',
        'data_fine',
    ];
}
