<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'level';

    protected $fillable = [
        'nama_level'
    ];

    public $timestamps = false;

    // (opsional) relasi balik
    public function users()
    {
        return $this->hasMany(User::class, 'id_level');
    }
}
