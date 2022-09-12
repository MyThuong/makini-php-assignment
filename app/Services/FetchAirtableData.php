<?php

namespace App\Services;


use App\Services\AirTable\AirtableService;
use App\Site;

class FetchAirtableData
{
    const ALL_TYPES = [
        'models',
        'services',
        'drawings',
        'model_model',
    ];

    public function __construct(Site $site = null)
    {
        if (!empty($site)) {
            $access_key = $site->airtable_access_key;
            $base_id = $site->airtable_base_id;
        }
        else {
            $access_key = config('airtable.access_key');
            $base_id = config('airtable.base_id');
        }

        $this->airtableService = new AirtableService($access_key, $base_id);
    }

    public function fetchAll($type)
    {
        if (!in_array($type, self::ALL_TYPES)) {
            return false;
        }

        $records = $this->airtableService->getAllRecords($type);
        return $records;
    }

    public function fetch($type)
    {
        if (!in_array($type, self::ALL_TYPES)) {
            return false;
        }
        $records = $this->airtableService->getRecords($type);
        return $records;
    }

}
