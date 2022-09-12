<?php

namespace App\Services\AirTable;

use App\AirtableModel;

class AirtableServiceService extends BaseAirtableService implements CanSaveRecordInterface
{
    protected $model = \App\AirtableService::class;

    public function saveRelations(&$fields)
    {
        if (!empty($fields['model'])) {
            $model_ref_id = $fields['model'][0];
            $model = AirtableModel::firstOrNew(['ref_id' => $model_ref_id]);
            $this->model->model()->associate($model);
        }
    }
}
