<?php

namespace App\Services;

use Carbon\Carbon;
use League\Csv\Writer;

class ExportService
{

    const EXPORT_TYPE_ALL_SITES = 'all_sites';

    public function getAllowExportTypes()
    {
        return [ExportService::EXPORT_TYPE_ALL_SITES];
    }

    /**
     * Export sites to csv
     *
     * @return Writer
     */

    //for later queue implementation
    public function runExport(array $data)
    {
        try {
            $csv = Writer::createFromFileObject(new \SplTempFileObject());

            $header = array_keys($data[0]);

            $csv->insertOne($header);

            $csv->insertAll($data);

        } catch (\Throwable $e) {
            throw $e;
        }

        return $csv;
    }

    public function generateExportFileName($type)
    {
        $now = Carbon::now();

        $current_date_string = $now->format('YmdHis');

        return $type . $current_date_string . '.csv';
    }
}
