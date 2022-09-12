<?php

namespace App\Http\Controllers;

use App\Services\AirTable\AirtableService;
use App\Site;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AirtableController extends Controller
{
    public function show(Request $request, $site_id)
    {
        $site = Site::findOrFail($site_id);

        if (empty($site->airtable_access_key) || empty($site->airtable_base_id)) {
            throw new NotFoundHttpException();
        }

        $airTableService = new AirtableService($site->airtable_access_key, $site->airtable_base_id);

        $nodes = $airTableService->buildModelTree();

        return view('airtables.nodes', ['nodes' => $nodes]);

    }
}
