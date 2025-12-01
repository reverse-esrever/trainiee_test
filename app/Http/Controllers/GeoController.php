<?php

namespace App\Http\Controllers;

use App\Http\DTO\GeoDTO;
use App\Http\Requests\Geo\GeoStoreRequest;
use App\Services\GeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class GeoController extends Controller
{
    public function __construct(public GeoService $service, public GeoDTO $dto)
    {

    }

    public function index()
    {
        $geos = session('GeoData') ?? [];
        $geos = $this->dto->getDTOGeoAddresses($geos);
        return view('geo.index', compact('geos'));
    }

    public function store(GeoStoreRequest $request)
    {
        $data = $request->validated();
        $data = $this->service->getDataFromAddress($data);
        return redirect()->route('geo.index')->with('GeoData', $data);
    }

    public function show(string $coords){
        $data = $this->service->getDataFromCoords($coords);
        $geo = $this->dto->getDTOGeoInfo($data);
        return view('geo.show', compact('geo'));
    }
}
