<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Finanziatore extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_progetto',
        'id_finanziatore',
        'fondo',
    ];
}
