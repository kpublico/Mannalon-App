<?php

namespace App\Modules\Market\Services;

use App\Modules\Market\Models\CommodityPrice;
use Exception;

class MarketService
{
    /**
     * Get current commodity prices
     */
    public function getCurrentPrices(int $limit = 20)
    {
        return CommodityPrice::orderByDesc('date_updated')
            ->orderBy('commodity')
            ->limit($limit)
            ->get();
    }

    /**
     * Get price trend for a commodity
     */
    public function getPriceTrend(string $commodity, int $days = 30)
    {
        $startDate = now()->subDays($days);

        return CommodityPrice::where('commodity', $commodity)
            ->whereDate('date_updated', '>=', $startDate)
            ->orderBy('date_updated')
            ->get();
    }

    /**
     * Search prices by commodity
     */
    public function searchCommodity(string $query, int $limit = 20)
    {
        return CommodityPrice::where('commodity', 'like', '%' . $query . '%')
            ->orderByDesc('date_updated')
            ->limit($limit)
            ->get();
    }

    /**
     * Add new price entry
     */
    public function addPrice(array $data): CommodityPrice
    {
        try {
            return CommodityPrice::create([
                'commodity' => $data['commodity'],
                'price' => $data['price'],
                'unit' => $data['unit'] ?? 'per kg',
                'region' => $data['region'] ?? null,
                'date_updated' => $data['date_updated'] ?? now(),
            ]);
        } catch (Exception $e) {
            throw new Exception('Price entry creation failed: ' . $e->getMessage());
        }
    }
}
