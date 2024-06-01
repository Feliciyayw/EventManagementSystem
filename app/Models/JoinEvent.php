<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinEvent extends Model
{

    protected $table = 'join_event';

    protected $fillable = [
        'id_event',
        'judul',
        'status_join',
        'id_need_crew',
        'created_by',
        'updated_by',
    ];
}
