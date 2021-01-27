<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{

    protected $table = 'polls';

    protected $casts = [
        'poll_id' => 'integer',
        'description' => 'string',
        'views' => 'integer',
        'created_at' => 'integer',
        'updated_at' => 'integer',




    ];

    //atributo fillable
    protected $fillable = [
        'poll_id',
        'description',
        'views',
        'created_at',
        'updated_at'


    ];
}
