<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clients_id',
        'date_ini',
        'date_end',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'clients_id');
    }

    public function watchmen()
    {
        return $this->belongsToMany(Watchmen::class, 'assignment_as_watchmen', 'assignment_id', 'watchmen_id')->withPivot(['id', 'start', 'date_ini', 'date_end', 'replacement_of', 'is_active', 'shifts_id']);
    }

    public function watchmen_activated()
    {
        return $this->belongsToMany(Watchmen::class, 'assignment_as_watchmen', 'assignment_id', 'watchmen_id')->withPivot(['id', 'start', 'date_ini', 'date_end', 'replacement_of', 'is_active', 'shifts_id'])->where('assignment_as_watchmen.is_active', '1');
    }

    public function novelty()
    {
        return $this->hasMany(News::class, 'assignment_id');
    }
}
