<?php

namespace App\Services\AirTable;


use App\AirtableDrawing;

class AirtableDrawingService extends BaseAirtableService implements CanSaveRecordInterface
{
    protected $model = AirtableDrawing::class;
}
