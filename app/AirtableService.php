<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirtableService extends Model
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    protected $guarded = ['model'];
    protected $attributes = ['recurring' => false];

    public function model()
    {
        return $this->belongsTo(AirtableModel::class, 'model_id');
    }

    public function ownServiceGroup()
    {
        return $this->hasMany(AirtableService::class, 'service_group_id');
    }

    public function serviceGroups()
    {
        return $this->hasMany(AirtableService::class, 'service_group_id');
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
    }
}
