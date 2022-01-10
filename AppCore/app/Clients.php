<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'salary',
        'num_services',
        'shifts_id',
        'is_active',
        'phone',
        'email',
        'address',
        'name_person',
        'num_watchmen',
        'type_of_programming',
    ];

    public function shift()
    {
        return $this->belongsTo(Shifts::class, 'shifts_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'clients_id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'clients_id');
    }
}
