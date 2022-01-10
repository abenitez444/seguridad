<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ResignationsAndDismissals extends Model
{
    protected $table = 'resignations_and_dismissals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'date',
        'url_doc',
        'details',
        'is_active',
        'ext_doc',
        'has_doc',
    ];

    public function watchmen()
    {
        return $this->belongsToMany(Watchmen::class, 'watchmen_has_dismissals', 'resignations_and_dismissals_id', 'watchmen_id')->withPivot('is_principal');
    }
}
