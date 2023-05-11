<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'asaas_id',
        'value',
        'status',
        'dueDate'
    ];

}
