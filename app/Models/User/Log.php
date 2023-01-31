<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'users_logs';

    protected $fillable = ['user_id', 'method', 'activity', 'ipAddress'];

    protected $hidden = [];

    protected $casts = [];

    protected $dates = [];

    protected $with = [];

    protected $appends = [];

    public static $snakeAttributes = false;
}
