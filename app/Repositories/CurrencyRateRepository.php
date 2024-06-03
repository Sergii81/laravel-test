<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CurrencyRateRepositoryInterface;
use App\Models\CurrencyRate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class CurrencyRateRepository extends AbstractRepository implements CurrencyRateRepositoryInterface
{
    /**
     * @return CurrencyRate
     */
    public function getModel(): CurrencyRate
    {
        return new CurrencyRate();
    }

    /**
     * @param Carbon $olderThan
     * @return void
     */
    public function clearValuesOlderThan(Carbon $olderThan): void
    {
        $query = $this->getQuery();

        $query
            ->where('fetched_at', '<=', $olderThan)
            ->delete();
    }
}
