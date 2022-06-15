<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country\Country;
use App\Models\Country\Region\City\City;
use App\Models\Country\Region\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function countries(): JsonResponse
    {
        $countries = Country::all(['id','name']);

        return new JsonResponse([
            'countries' => $countries,
        ]);
    }

    /**
     * @param int $country_id
     * @return JsonResponse
     */
    public function regions(int $country_id): JsonResponse
    {
        $regions = Region::where('country_id', $country_id)->get(['id', 'name']);

        return new JsonResponse([
            'regions' => $regions,
        ]);
    }

    /**
     * @param int $region_id
     * @return JsonResponse
     */
    public function cities(int $region_id): JsonResponse
    {
        $cities = City::where('region_id', $region_id)->get(['id', 'name']);

        return new JsonResponse([
            'cities' => $cities,
        ]);
    }
}
