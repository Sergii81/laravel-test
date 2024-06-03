<?php

namespace App\Console\Commands;

use App\Actions\Currency\SendDailyEmailsAction;
use Illuminate\Console\Command;

class SendDailyEmailsCommand extends Command
{
    protected $signature = 'app:send-daily-emails';

    protected $description = 'Send daily emails for subscribers';

    /**
     * @param SendDailyEmailsAction $sendDailyEmailsAction
     * @return void
     */
    public function handle(SendDailyEmailsAction $sendDailyEmailsAction): void
    {
        $sendDailyEmailsAction->execute();
    }
}
