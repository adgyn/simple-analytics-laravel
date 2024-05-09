<?php

namespace Adgyn\SimpleAnalytics\Services;

use Illuminate\Support\Collection;
use Ixudra\Curl\Facades\Curl;

class IpService
{
    /**
     * Get country data by ip
     *
     * @param string $ip
     * @return Collection
     */
    public static function getCountryData(string $ip): object
    {
        $response = Curl::to('https://api.iplocation.net/?ip='.$ip)->returnResponseObject()->asJson()->get();
        if($response->status == 200 AND $response->content->country_name != '-') {
            return (object) [
                'country' => $response->content->country_name,
                'code' => $response->content->country_code2,
            ];
        }

        return (object) [
            'country' => 'Not found',
            'code' => 'N/A',
        ];
    }
}