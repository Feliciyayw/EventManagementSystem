<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $table = 'event';

    protected $fillable = [
        'id_event',
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'gambar_event',
        'point_peserta',
        'size_of_event',
        'crew',
        'lokasi',
        'updated_at',
        'created_at'
    ];
}
