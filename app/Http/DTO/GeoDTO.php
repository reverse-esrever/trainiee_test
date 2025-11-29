<?php

namespace App\Http\DTO;

use Illuminate\Database\Eloquent\Casts\Json;

class GeoDTO
{
    public function getDTOGeoAddresses(array $data)
    {
        $geos = [];
        foreach ($data as $geo) {
            dump($geo);
            $geo = $geo['GeoObject'];
            $geo = $this->makeObject($geo);
            $geos[] = $geo;
        }

        return $geos;
    }

    public function makeObject(array $geo)
    {
        $geo = new class($geo) {
            public string $name;
            public string $description;
            public string $position;
            public function __construct($geo)
            {
                // ... код получения данных из API ...

                $addressDetails = $geo['metaDataProperty']['GeocoderMetaData']['AddressDetails']['Country']['AdministrativeArea'];
                dd($addressDetails);
                // Проверка наличия номера дома
                $house = $addressDetails['SubAdministrativeArea']['Locality']['Thoroughfare']['Premise']['PremiseNumber']
                    ?? ($addressDetails['Locality']['Thoroughfare']['Premise']['PremiseNumber'] ?? null);

                if ($house === null) {
                    // Номер дома не найден, пользователь ввел только улицу.
                    // Можете попросить пользователя ввести более точный адрес.
                }

                $this->name = $geo['name'];
                $this->description = $geo['description'];
                $this->position = $geo['Point']['pos'];
                // $this->nearlyMetro = $geo['description'];
                // $this->nearlyStreet = $geo['description'];
                // $this->nearlyHouse = $geo['description'];
                // $this->description = $geo['description'];
            }
        };

        return $geo;
    }
}
