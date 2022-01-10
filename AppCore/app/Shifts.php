<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    protected $table = 'shifts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'turn',
        'cant_turn',
        'cant_total',
        'cant_watchmen',
        'is_active',
    ];
}
