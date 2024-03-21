<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\GroupUserRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;
use App\Repositories\GroupUserRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface:: class, UserRepository::class);
        $this->app->bind(UserServiceInterface:: class, UserService::class);
        $this->app->bind(GroupUserRepositoryInterface:: class, GroupUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
