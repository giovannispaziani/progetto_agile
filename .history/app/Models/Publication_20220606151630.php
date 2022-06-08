<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'titolo',
        'fonte',
    ];

    public function scien () {

        return $this->belongsTo('app\Models\User');

    }

}
