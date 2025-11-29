<?php

namespace App\Http\Controllers;

use App\Http\DTO\GeoDTO;
use App\Http\Requests\Geo\GeoStoreRequest;
use App\Services\GeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeoController extends Controller
{
    public function __construct(public GeoService $service, public GeoDTO $dto)
    {

    }

    public function index()
    {
        return view('geo.index');
    }

    public function store(GeoStoreRequest $request)
    {
        $data = $request->validated();
        $data = $this->service->getAddressFromData($data);
        $data = $this->dto->getDTOGeoAddresses($data);
        dd($data);
    }
}
