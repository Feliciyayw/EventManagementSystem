<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailEvent extends Model
{

    protected $table = 'detail_event';

    protected $fillable = [
        'id_detail_event',
        'id_event',
        'id_users',
        'status_kehadiran',
        'created_at',
        'updated_by',
        'updated_at',
        'created_by'
    ];
}
