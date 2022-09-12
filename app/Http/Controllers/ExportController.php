<?php

namespace App\Http\Controllers;

use App\Services\ExportService;
use App\Services\SitesService;
use Illuminate\Http\Request;

class ExportController extends Controller
{

    public function export(Request $request, ExportService $export_service)
    {

        $this->validate($request, [
            'type' => 'required|string|in:' . implode($export_service->getAllowExportTypes())
        ]);

        switch ($request->input('type')) {
            case ExportService::EXPORT_TYPE_ALL_SITES: {
                $export_results =  $export_service->runExport((new SitesService())->getAllSiteExportWithUserData());
            }
        }

        return response((string)$export_results, 200, [
            'Content-Type' => 'text/csv',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Disposition' => 'attachment; filename="' . $export_service->generateExportFileName($request->input('type')) . '"',
        ]);
    }
}
