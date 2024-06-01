<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NeedCrew extends Model
{

    protected $table = 'need_crew';

    protected $fillable = [
        'id_event',
        'need_crew',
        'updated_at',
        'created_at'
    ];
}
