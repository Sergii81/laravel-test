<?php

namespace App\Http\Resources;

use App\Models\CurrencyRate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'CurrentRateResource',
    title: 'CurrentRateResource',
    description: 'CurrentRate Resource',
    properties: [
        new OA\Property(property: "buy", description: "Current buy currency rate", type: "float", example: 39.5),
        new OA\Property(property: "sale", description: "Current sale currency rate", type: "float", example: 39.5),
    ],
)]
class CurrentRateResource extends JsonResource
{
    /** @var CurrencyRate */
    public $resource;

    /**
     * @var bool
     */
    public static $wrap = false;

    public function toArray(Request $request): array
    {
        return [
            'buy' => $this->buy_rate,
            'sale' => $this->sale_rate,
        ];
    }
}
