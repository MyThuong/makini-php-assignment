<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use App\Services\SitesService;
use App\Site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class SitesController extends Controller
{
    const SITE_TYPES = [
        'Vessel',
        'Power plant',
        'Utility structure',
        'Manufacturing facility',
        'Mining facility',
        'Oil and gas production facility">Oil and gas production facility',
        'Data Center',
        'Tall building',
        'Hotels and resorts',
        'Amusement park'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:view,site')->only('show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SitesService $sitesService)
    {
        $sites = $sitesService->getAllPaginated();

        return view('sites.index', [
            'sites' => $sites,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Site $site
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function show(Site $site)
    {

        return view('sites.detail', [
            'site' => $site
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function create()
    {
        $randomVesselNames = [
            'The Blankney',
            'Beaver',
            'Quainton',
            'Churchill',
            'Thatcham',
            'Cowper',
            'Adelaide',
            'The Kildimo',
            'Infanta',
        ];

        return view('sites.form', [
            'namePlaceholder' => '"' . $randomVesselNames[array_rand($randomVesselNames)] . '"',
            'site' => new Site(),
            'default_types' => self::SITE_TYPES
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSiteRequest $request, SitesService $sitesService)
    {

        DB::beginTransaction();

        try {

            $sitesService->create($request->all());

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('sites.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Site $site
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function edit(Site $site)
    {
        return view('sites.form', [
            'site' => $site,
            'default_types' => self::SITE_TYPES
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Site $site
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSiteRequest $request, Site $site, SitesService $sitesService)
    {
        $data = $request->all();

        DB::beginTransaction();

        try {

            $sitesService->update($site, $data);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->withError($e->getMessage())->withInput();
        }

        return redirect()->route('sites.index');
    }

}
