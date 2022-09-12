<?php

namespace App\Services;

use App\Http\Resources\SiteResource;
use App\Services\AirTable\AirtableService;
use App\Site;

class SitesService
{

    public function getAllPaginated($perPage = 10)
    {
        return Site::paginate($perPage);
    }

    public function getAll()
    {
        return Site::all();
    }

    public function create(array $data)
    {
        if (!(new AirtableService($data['airtable_access_key'], $data['airtable_base_id']))->authentication()) {
            throw new \Exception('Invalid Credentials.', 403);
        }

        $site = Site::create($data);
        return $site;
    }

    public function update($site, array $data)
    {
        if (!(new AirtableService($data['airtable_access_key'], $data['airtable_base_id']))->authentication()) {
            throw new \Exception('Invalid Credentials.', 403);
        }

        return $site->update($data);
    }

    /**
     * Get sites collection to export
     *
     * @return array
     */
    public function getAllSiteExportWithUserData()
    {
        $query = Site::all();
        return SiteResource::collection($query)->toArray(request());

    }
}
