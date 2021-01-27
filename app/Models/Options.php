<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Options extends Model
{

    protected $table = 'options';

    protected $casts = [
        'id' => 'integer',
        'poll_id' => 'integer',
        'description' => 'string',
        'votes' => 'integer',
        'created_at' => 'integer',
        'updated_at' => 'integer',

    ];

    //atributo fillable
    protected $fillable = [
        'id',
        'poll_id',
        'votes',
        'description',
        'created_at',
        'updated_at'


    ];
}
