<?php

namespace App\Actions\Currency;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Jobs\SendDailyEmailJob;
use App\Models\CurrencyRate;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SendDailyEmailsAction
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param GetCurrentRateAction $getCurrentRateAction
     */
    public function __construct(
       protected UserRepositoryInterface $userRepository,
        protected GetCurrentRateAction $getCurrentRateAction,
    ) {
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        /** @var CurrencyRate $currencyRate */
        $currencyRate = $this->getCurrentRateAction->execute();

        if (! $currencyRate) {
            Log::error('Current rate not found. Can\'t send mails.');
            return;
        }

        $users = $this->userRepository->getAll();

        foreach ($users as $user) {
            /** @var User $user */
            SendDailyEmailJob::dispatch($user, $currencyRate);
        }
    }
}
