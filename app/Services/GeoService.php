<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeoService{
    public function getAddressFromData(array $data): array{
        $address = $data['address'];
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
}