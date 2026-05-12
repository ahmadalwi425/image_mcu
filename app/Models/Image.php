<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'no_mr',
        'reg_no',
        'nama',
        'tanggal_lahir',
        'tanggal_pendaftaran',
        'pekerjaan',
        'deskripsi',
        'file_path',
        'user_id'
    ];
}