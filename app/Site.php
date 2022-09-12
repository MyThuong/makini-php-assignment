<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'name',
        'type',
        'airtable_access_key',
        'airtable_base_id',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function (Site $site) {
            $site->user()->associate(auth()->user());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
