<?php

namespace App\Console\Commands;

use App\Actions\Currency\FetchCurrencyRateAction;

use App\Actions\Currency\StoreCurrencyRateAction;
use App\DTOs\CurrencyRateDTO;
use App\Enums\CurrencyCodeEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchCurrencyRateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-currency-rate-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch currency rates from API';

    /**
     * Execute the console command.
     */
    public function handle(
        FetchCurrencyRateAction $fetchCurrencyRate,
        StoreCurrencyRateAction $storeCurrencyRateAction
    )
    {
        $vo = $fetchCurrencyRate->execute();
        if (! $vo->hasError()) {
            $usdDto = CurrencyRateDTO::fromArray([
                'currency_code' => CurrencyCodeEnum::USD->value,
                'buy_rate' => $vo->getUSDBuyRate(),
                'sale_rate' => $vo->getUSDSaleRate(),
            ]);

            $storeCurrencyRateAction->execute($usdDto);
        } else {
            Log::error('Can\'t fetch currency rate', ['error' => $vo->getError()]);
        }
    }
}
