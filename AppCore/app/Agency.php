<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agency extends Authenticatable
{
    use Notifiable;
    protected $table = 'agency';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'avatar',
        'name',
        'last_name',
        'rut',
        'local_agency',
        'tlf_agency',
        'desc_sociality',
        'email',
        'email_verified',
        'email_verified_at',
        'country',
        'state',
        'password',
        'address',
        'is_active',
        'is_admin',
        'is_superadmin',
        'type',
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
