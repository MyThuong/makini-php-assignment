<?php

namespace App\Services\AirTable;


use App\AirtableModel;

class AirtableModelsService extends BaseAirtableService implements CanSaveRecordInterface
{
    protected $model = AirtableModel::class;

}
