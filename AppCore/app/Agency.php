<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Agency extends Model
{
    protected $table = 'agency';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'avatar',
        'name_agency',
        'rut',
        'local_agency',
        'tlf_agency',
        'desc_sociality',
        'email',
        // 'email_verified',
        // 'email_verified_at',
        'country',
        'state',
        'password',
        'address',
        // 'is_active',
        // 'is_admin',
        // 'is_superadmin',
        // 'type',
    ];
}
