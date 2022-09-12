<?php

namespace App\Services\AirTable;

class BaseAirtableService
{
    /** @var \Illuminate\Database\Eloquent\Model $model */
    protected $model;

    public function saveRecords($records)
    {
        foreach ($records as $record) {
            $fields = $record['fields'];
            $fields['ref_id'] = $record['id'];
            $this->model = $this->model::firstOrNew(['ref_id' => $record['id']]);
            $this->saveRelations($fields);
            $this->model->fill($fields)->save();
        }

    }

    public function saveRelations(&$fields)
    {

    }
}
