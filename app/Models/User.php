<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guard = 'user';

    protected $table = 'users';

    protected $fillable = ['uuid', 'email', 'password', 'name', 'phoneNumber', 'country_id', 'activationKey', 'forgottenPasswordKey'];

    protected $hidden = ['password', 'activationKey', 'forgottenPasswordKey', 'remember_token'];

    protected $casts = [];

    protected $dates = [];

    protected $with = [];

    protected $appends = [];

    public static $snakeAttributes = false;

    // Relationships //
    public function country() {
        return $this->belongsTo('App\Models\System\Country');
    }

    public function logs() {
        return $this->hasMany('App\Models\User\Log')->orderBy('id', 'DESC');
    }

    // Methods //
    public function logActivity($activity) {
        $this->logs()->create([
            'method'    => request()->route()->getActionMethod().'()',
            'activity'  => $activity,
            'ipAddress' => request()->ip()
        ]);
    }

    public function isActive() {
        return empty($this->activationKey);
    }
}
