<?php

namespace App\Services\AirTable;

use App\AirtableDrawing;
use App\AirtableModel;
use App\AirtableModelModel;

class AirtableModelModelService extends BaseAirtableService implements CanSaveRecordInterface
{
    protected $model = AirtableModelModel::class;

    public function saveRelations(&$fields)
    {
        parent::saveRelations($fields);

        if (!empty($fields['number'])) {
            $child_model = AirtableModel::firstOrCreate(['ref_id' => $fields['number'][0]]);
            $this->model->child()->associate($child_model);
        }

        if (!empty($fields['parent_number'])) {
            $parent_model = AirtableModel::firstOrCreate(['ref_id' => $fields['parent_number'][0]]);
            $this->model->parent()->associate($parent_model);
        }

        if (!empty($fields['dwg_no'])) {
            $drawing = AirtableDrawing::firstOrNew(['ref_id' => $fields['dwg_no'][0]]);
            $this->model->drawing()->associate($drawing);
        }
    }

}
