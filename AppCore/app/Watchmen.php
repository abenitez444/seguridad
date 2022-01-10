<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class Watchmen extends Model
{
    protected $table = 'watchmen';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'dni',
        'email',
        'phone',
        'address',
        'is_active',
        'i_quit',
        'is_dismissal',
        'is_delete',
        'is_disconnected',
    ];

    public function assignment()
    {
        return $this->belongsToMany(Assignment::class, 'assignment_as_watchmen', 'watchmen_id', 'assignment_id')->withPivot(['start', 'date_ini', 'date_end', 'replacement_of', 'is_active', 'shifts_id', 'assignment_id']);
    }

    public function activated_in_assignment()
    {
        if (DB::table('assignment_as_watchmen')->where('watchmen_id', $this->id)->where('is_active', '1')->count() > 0) {
            return true;
        }
        return false;
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'watchmen_has_news', 'watchmen_id', 'news_id')->withPivot(['is_principal']);
    }
}
