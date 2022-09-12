<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirtableModelModel extends Model
{
    protected $table = 'airtable_model_model';
    protected $guarded = ['dwg_no', 'id', 'child_id', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(AirtableModel::class, 'parent_id');
    }
    public function child()
    {
        return $this->belongsTo(AirtableModel::class, 'child_id');
    }
    public function drawing()
    {
        return $this->belongsTo(AirtableDrawing::class, 'dwg_id');
    }
}
