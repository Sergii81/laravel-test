<?php

namespace App\Providers;

use App\Adapters\PrivatBankCurrencyRateAdapter;
use App\Interfaces\Adapters\CurrencyRateAdapterInterface;
use App\Interfaces\Repositories\CurrencyRateRepositoryInterface;
use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\Post;
use App\Policies\PostPolicy;
use App\Repositories\CurrencyRateRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerAdapters();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
        Gate::policy(Post::class, PostPolicy::class);
    }

    public function registerRepositories(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CurrencyRateRepositoryInterface::class, CurrencyRateRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    private function registerAdapters(): void
    {
        $this->app->bind(CurrencyRateAdapterInterface::class, PrivatBankCurrencyRateAdapter::class);
    }
}
