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
            $geo = $geo['GeoObject'];
            $geo = $this->makeObject($geo);
            $geos[] = $geo;
        }

        return $geos;
    }

    public function getDTOGeoInfo(array $data)
    {
        $geo = new class($data) {
            public array $locality;
            public array $metro;
            public array $street;
            public array $house;
            public function __construct($data)
            {
                foreach ($data as $key => $info) {
                    $this->$key = $info ?? null;
                }
            }
        };
        return $geo;
    }

    protected function makeObject(array $geo)
    {
        $geo = new class($geo) {
            public string $name;
            public string $description;
            public string $pos;
            public ?string $nearlyMetro;
            public ?string $nearlyStreet;
            public ?string $nearlyHouse;
            public function __construct($geo)
            {
                $this->name = $geo['name'];
                $this->description = $geo['description'];
                $this->pos = implode(",", explode(' ', $geo['Point']['pos']));
                $this->nearlyMetro = $geo['nearlyMetro'] ?? null;
                $this->nearlyStreet = $geo['nearlyStreet'] ?? null;
                $this->nearlyHouse = $geo['nearlyHouse'] ?? null;
            }
        };

        return $geo;
    }
}
