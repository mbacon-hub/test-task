<?php

namespace App\Providers;

use App\Api\V1\Repositories\Interfaces\OperationRepositoryInterface;
use App\Api\V1\Repositories\Interfaces\ProductRepositoryInterface;
use App\Api\V1\Repositories\Interfaces\UserRepositoryInterface;
use App\Api\V1\Repositories\OperationRepository;
use App\Api\V1\Repositories\ProductRepository;
use App\Api\V1\Repositories\UserRepository;
use App\Api\V1\Services\AuthService;
use App\Api\V1\Services\Interfaces\AuthServiceInterface;
use App\Api\V1\Services\Interfaces\OperationServiceInterface;
use App\Api\V1\Services\Interfaces\ProductServiceInterface;
use App\Api\V1\Services\Interfaces\UserBalanceServiceInterface;
use App\Api\V1\Services\OperationService;
use App\Api\V1\Services\ProductService;
use App\Api\V1\Services\UserBalanceService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OperationRepositoryInterface::class, OperationRepository::class);

        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(UserBalanceServiceInterface::class, UserBalanceService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(OperationServiceInterface::class, OperationService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
