<?php

namespace App\Http\DTO;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Http;

class GeoDTO
{
    public function getDTOGeoAddresses(array $data)
    {
        $geos = [];
        foreach ($data as $geo) {
            dump($geo);
            $geo = $geo['GeoObject'];
            $geo = $this->makeObject($geo);
            $response = Http::get("https://geocode-maps.yandex.ru/v1", [
                "apikey" => env("GEO_CODER_API"),
                "geocode" => "$geo->pos",
                "format" => "json",
                "results" => "5"
            ]);
            dd("geo brbrbrbr",$response->json());
            $geos[] = $geo;
        }

        return $geos;
    }

    public function makeObject(array $geo)
    {
        $geo = new class($geo) {
            public string $name;
            public string $description;
            public string $pos;
            public array $info;
            public function __construct($geo)
            {
                // ... код получения данных из API ...
                // dd()
                $addressDetails = $geo['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea'];
                dd($addressDetails);
                // Проверка наличия номера дома
                // $house = $addressDetails['SubAdministrativeArea']['Locality']['Thoroughfare']['Premise']['PremiseNumber']
                //     ?? ($addressDetails['Locality']['Thoroughfare']['Premise']['PremiseNumber'] ?? null);

                // if ($house === null) {
                //     // Номер дома не найден, пользователь ввел только улицу.
                //     // Можете попросить пользователя ввести более точный адрес.
                // }

                $this->name = $geo['name'];
                $this->description = $geo['description'];
                $this->pos = $geo['Point']['pos'];
                // $this->nearlyMetro = $geo['description'];
                // $this->nearlyStreet = $geo['description'];
                // $this->nearlyHouse = $geo['description'];
                // $this->description = $geo['description'];
            }
        };

        return $geo;
    }
}
