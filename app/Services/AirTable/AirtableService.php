<?php

namespace App\Services\AirTable;


use App\Services\TreeViewService;
use GuzzleHttp\Client;

class AirtableService
{
    const BASE_URL = 'https://api.airtable.com';
    const VERSION = 'v0';
    protected $client;
    protected $uri;

    public function __construct($accessKey, $baseId)
    {
        $baseUri = self::BASE_URL . '/' . self::VERSION . '/' . $baseId . '/';

        $config = [
            'base_uri' => $baseUri,
            'headers' => [
                'Authorization' => 'Bearer ' . $accessKey
            ]
        ];

        $this->client = new Client($config);
    }

    public function authentication()
    {
        try {
            $this->client->get('models', ['query' => ['maxRecords' => 1]]);
            return true;
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function buildModelTree()
    {
        $tree = [];
        $models_records = $this->getAllRecords('models');

        if ($models_records) {
            $treeViewService = new TreeViewService();
            $tree = $treeViewService($models_records['records']);
        }

        return $tree;
    }

    public function getRecords($table, $options = [])
    {
        try {

            $response = $this->client->get($table, [
                'query' => $options,
            ]);

            $content = $response->getBody()->getContents();

            if ($content) {
                $content = json_decode($content, true);
            }

            return $content;
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function getAllRecords($table)
    {
        $records = [];
        $options = ['view' => 'Grid view',
            'pageSize' => 100
        ];

        $offset = null;

        do {

            $options['offset'] = $offset;
            $content = $this->getRecords($table, $options);
            $offset = $content['offset'] ?? null;
            $records  = array_merge($records, $content['records']);

        } while ($offset);

        return ['records' => $records];

    }

}
