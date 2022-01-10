<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Operations extends Model
{
    protected $table = 'operations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'assignment_clients_id');
    }

    /*public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function client_change()
    {
        return $this->belongsTo(Clients::class, 'clients_id_change');
    }

    public function watchmen()
    {
        return $this->belongsToMany(Watchmen::class, 'watchmen_has_news', 'news_id', 'watchmen_id')->withPivot('is_principal');
    }*/
}
