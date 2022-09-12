<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirtableDrawing extends Model
{

    protected $guarded = ['model_model'];

    public function modelModel()
    {
        return $this->hasMany(AirtableModelModel::class, 'dwg_id', 'id');
    }
}
