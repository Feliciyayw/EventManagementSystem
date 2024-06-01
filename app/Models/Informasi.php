<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{

    protected $table = 'informasi';

    protected $fillable = [
        'id_informasi',
        'judul',
        'deskripsi',
        'id_users',
        'gambar_infromasi',
        'updated_at',
        'created_at'
    ];
}
