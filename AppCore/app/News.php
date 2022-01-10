<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'date_ini',
        'date_end',
        'url_doc',
        'details',
        'is_active',
        'ext_doc',
        'has_doc',
        'clients_id',
        'shifts_double',
        'shifts_new',
        'clients_id_change',
        'assignment_id',
        'assignment_clients_id',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'assignment_clients_id');
    }

    public function assignment()
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
    }
}
