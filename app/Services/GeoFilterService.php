<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class GeoFilterService
{
    protected string $localityName;

    public function __construct()
    {
        return $this;
    }

    public function setLocalityName(string $name)
    {
        $this->localityName = $name;
        return $this;
    }

    public function filter(array $data): array
    {
        $filtered = [];
        foreach ($data as $geo) {
            if ($this->check($geo)) {
                $filtered[] = $geo;
            }
        }
        return $filtered;
    }

    protected function check(array $singleGeo): bool
    {
        if (isset($this->localityName)) {
            $metadata = $singleGeo['GeoObject']['metaDataProperty']['GeocoderMetaData'] ?? "";
            $localityName = $metadata['AddressDetails']['Country']['AdministrativeArea']['AdministrativeAreaName'] ?? "";
            if ($localityName !== $this->localityName) {
                return false;
            }
        }

        return true;
    }
}
