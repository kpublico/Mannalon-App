<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Address\PhRegion;
use App\Models\Address\PhProvince;
use App\Models\Address\PhCity;
use App\Models\Address\PhBarangay;

class LocationController extends Controller
{
    /**
     * Get all Philippine regions.
     */
    public function regions(): JsonResponse
    {
        $regions = PhRegion::orderBy('region_id')
            ->get(['code', 'name', 'region_id'])
            ->map(fn ($r) => ['code' => $r->region_id, 'name' => $r->name]);

        return response()->json($regions);
    }

    /**
     * Get provinces by region code (region_id).
     */
    public function provinces(Request $request): JsonResponse
    {
        $regionCode = $request->query('region_code');
        if (!$regionCode) {
            return response()->json(['error' => 'Region code is required'], 422);
        }

        $provinces = PhProvince::where('region_id', $regionCode)
            ->orderBy('name')
            ->get(['code', 'name', 'region_id', 'province_id'])
            ->map(fn ($p) => ['code' => $p->province_id, 'name' => $p->name]);

        return response()->json($provinces);
    }

    /**
     * Get cities/municipalities by province code (province_id).
     */
    public function cities(Request $request): JsonResponse
    {
        $provinceCode = $request->query('province_code');
        if (!$provinceCode) {
            return response()->json(['error' => 'Province code is required'], 422);
        }

        $cities = PhCity::where('province_id', $provinceCode)
            ->orderBy('name')
            ->get(['code', 'name', 'province_id', 'city_id'])
            ->map(fn ($c) => ['code' => $c->city_id, 'name' => $c->name]);

        return response()->json($cities);
    }

    /**
     * Get barangays by city/municipality code (city_id).
     */
    public function barangays(Request $request): JsonResponse
    {
        $cityCode = $request->query('city_code');
        if (!$cityCode) {
            return response()->json(['error' => 'City code is required'], 422);
        }

        $barangays = PhBarangay::where('city_id', $cityCode)
            ->orderBy('name')
            ->get(['code', 'name', 'city_id'])
            ->map(fn ($b) => ['code' => $b->code, 'name' => $b->name]);

        return response()->json($barangays);
    }
}
