<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email', 
        'password',
        'phone',
        'type', 
        'email_verified', 
        'email_verified_at',
        'address',
        'is_active',
        'is_admin',
        'is_superadmin',
        'image',
        'cellular',
        'postal_code',
        'dni',

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

    public function getUrlImage()
    {
        return asset('/').\Storage::url($this->image);
    }

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'users_has_roles', 'users_id', 'roles_id');
    }

    public function has_role($role)
    {
        $rol_in_user = false;
        foreach ($this->roles()->get() as $rol) {
            if ($rol->name == $role) {
                $rol_in_user = true;
                break;
            }
        }
        return $rol_in_user;
    }
}
