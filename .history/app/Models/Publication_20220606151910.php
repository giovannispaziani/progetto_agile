<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillPubblicazione = [
        'titolo',
        'fonte',
    ];

    public function publications () {

        return $this->belongsTo('app\Models\User');

    }

}
