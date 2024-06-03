<?php

namespace App\Jobs;

use App\Mail\CurrentRateMail;
use App\Models\CurrencyRate;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDailyEmailJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @param User $user
     * @param CurrencyRate $currencyRate
     */
    public function __construct(
        public User $user,
        public CurrencyRate $currencyRate,
    ) {
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(
            new CurrentRateMail(
                USDBuyRate: $this->currencyRate->buy_rate,
                USDSaleRate: $this->currencyRate->sale_rate
            )
        );
    }
}
