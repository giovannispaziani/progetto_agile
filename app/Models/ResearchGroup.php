<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_progetto',
        'id_ricercatore',
    ];
}
