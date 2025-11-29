<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\GeoFilterService;

class GeoService{

    public function getAddressFromData(array $data): array{
        $address = $data['address'];
        $data = $this->directGeocoding($address);
        
        $geoFilter = new GeoFilterService()->setLocalityName("Москва");
        $data = $geoFilter->filter($data);
        foreach($data as $geo){
            $coords = $geo['GeoObject']['Point']['pos'];
            $coords = implode(",",explode(" ", $coords));
            $geo['GeoObject']['metro'] = $this->reverseGeocoding($coords, 'metro');
            $geo['GeoObject']['street'] = $this->reverseGeocoding($coords, 'street');
            $geo['GeoObject']['house'] = $this->reverseGeocoding($coords, 'house');
            dd($geo);
        }
        $response = Http::get("https://geocode-maps.yandex.ru/v1",[
            "apikey" => env("GEO_CODER_API"),
            "geocode" => "37.781506,55.787761",
            "format" => "json",
            "results" => "1",
        ]);
        dd($response->json());
        
        return $data;
    }

    protected function directGeocoding(string $address){
        $response = Http::get("https://geocode-maps.yandex.ru/v1",[
            "apikey" => env("GEO_CODER_API"),
            "geocode" => "$address",
            "bbox" => "36.83,55.48~37.95,56.03",
            "format" => "json",
            "results" => "5"
        ]);
        $data = $response->json();
        return $data['response']['GeoObjectCollection']['featureMember'];
    }
    protected function reverseGeocoding(string $coords, string $kind = "locality"){
        $response = Http::get("https://geocode-maps.yandex.ru/v1",[
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
}