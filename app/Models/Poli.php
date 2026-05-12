<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';

    protected $fillable = [
        'nama_poli'
    ];

    public $timestamps = false;

    // (opsional) relasi balik
    public function users()
    {
        return $this->hasMany(User::class, 'id_poli');
    }
}