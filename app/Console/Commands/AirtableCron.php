<?php

namespace App\Console\Commands;

use App\Services\AirTable\AirtableDrawingService;
use App\Services\AirTable\AirtableModelModelService;
use App\Services\AirTable\AirtableModelsService;
use App\Services\AirTable\AirtableServiceService;
use App\Services\FetchAirtableData;
use App\Site;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AirtableCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'airtable:cron {--t|type=} {--s|site=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Data From AirTable';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    const OPTION_TYPE_ALL = 'all';
    const OPTION_TYPE_MODELS = 'models';
    const OPTION_TYPE_MODEL_MODEL = 'model_model';
    const OPTION_TYPE_DRAWINGS = 'drawings';
    const OPTION_TYPE_SERVICES = 'services';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $site_id = $this->option('site') ?: null;

        $site = null;

        if($site_id) {
            $site = Site::findOrFail($site_id);
        }

        $fetch = new FetchAirtableData($site);

        $type = $this->option('type');

        if (!$type || $type === static::OPTION_TYPE_ALL) {
            $types = FetchAirtableData::ALL_TYPES;
        }
        else if(in_array($type, FetchAirtableData::ALL_TYPES)) {
            $types = [$type];
        }
        else {
            $this->error('Airtable table not found!');
            return;
        }

        foreach ($types as $type) {

            $responses = $fetch->fetchAll($type);

            if (empty($responses['records'])) {
                continue;
            }

            switch ($type) {
                case static::OPTION_TYPE_MODELS:
                    $service = new AirtableModelsService();
                    break;
                case static::OPTION_TYPE_MODEL_MODEL:
                    $service = new AirtableModelModelService();
                    break;
                case static::OPTION_TYPE_DRAWINGS:
                    $service = new AirtableDrawingService();
                    break;
                case static::OPTION_TYPE_SERVICES:
                    $service = new AirtableServiceService();
                    break;
            }

            DB::beginTransaction();

            try {

                $service->saveRecords($responses['records']);

                DB::commit();

            } catch (\Throwable $e) {
                $this->error($e->getMessage());
                DB::rollBack();
            }

        }

        $this->info('Airtable fetch data successfully!');
    }

}
