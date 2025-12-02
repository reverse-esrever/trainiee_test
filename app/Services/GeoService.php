<?php

namespace App\Services;

use App\Models\UserQuery;
use Illuminate\Support\Facades\Http;
use App\Services\GeoFilterService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeoService
{

    public function getDataFromAddress(array $data): array
    {
        $address = $data['address'];
        $data = $this->directGeocoding($address);
        $geoFilter = (new GeoFilterService())->setLocalityName("Москва");
        $data = $geoFilter->filter($data);
        return $data;
    }
    public function getDataFromCoords(string $coords): array
    {
        $data = [];
        $data['locality'] = $this->reverseGeocoding($coords);
        $data['metro'] = $this->reverseGeocoding($coords, 'metro');
        $data['street'] = $this->reverseGeocoding($coords, 'street');
        $data['house'] = $this->reverseGeocoding($coords, 'house');
        return $data;
    }



    protected function directGeocoding(string $address)
    {
        $response = Http::get("https://geocode-maps.yandex.ru/v1", [
            "apikey" => env("GEO_CODER_API"),
            "geocode" => "$address",
            "bbox" => "36.83,55.48~37.95,56.03",
            "format" => "json",
            "results" => "5"
        ]);
        $data = $response->json();
        return $data['response']['GeoObjectCollection']['featureMember'];
    }

    protected function reverseGeocoding(string $coords, string $kind = "locality")
    {
        $response = Http::get("https://geocode-maps.yandex.ru/v1", [
            "apikey" => env("GEO_CODER_API"),
            "geocode" => "$coords",
            "kind" => "$kind",
            "format" => "json",
            "results" => "1"
        ]);
        $data = $response->json();
        $kind = [];
        $kind['name'] = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['name'];
        $kind['description'] = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['description'];
        return $kind;
    }

    public function saveQuery(string $address): void
    {
        $address = trim(preg_replace('/[\s]{2,}/',' ',$address));
        UserQuery::updateOrCreate([
            'text' => $address,
            'user_id' => Auth::id(),
        ], ['updated_at' => now()]);
    }
    public function getQueries(): Collection
    {
        $user = Auth::user();
        return $user->queries()->orderBy('updated_at', 'desc')->limit(5)->get();       
    }
}
