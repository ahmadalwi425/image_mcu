<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegSIMRS extends Model
{
    protected $connection = 'odbc';
    protected $table = 'v_daily_mcu_2';
}
