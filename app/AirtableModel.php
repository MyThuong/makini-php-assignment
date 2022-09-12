<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirtableModel extends Model
{

    protected $fillable = [
        'ref_id',
        'number',
        'description',
        'unit',
        'note',
        'interchangeable_with_id'
    ];

    public function parents()
    {
        return $this->belongsToMany(AirtableModel::class, 'airtable_model_model', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->belongsToMany(AirtableModel::class, 'airtable_model_model', 'id', 'child_id');
    }

    public function interchangeableWiths()
    {
        return $this->hasMany(AirtableModel::class, 'interchangeable_with_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(AirtableService::class, 'model_id', 'id');
    }
}
