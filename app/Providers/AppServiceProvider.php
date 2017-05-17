<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Song\SongRepository;
use App\Repositories\Song\SongRepositoryInterface;
use App\Repositories\Singer\SingerRepository;
use App\Repositories\Singer\SingerRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        App::bind(UserRepositoryInterface::class, UserRepository::class);
        App::bind(SongRepositoryInterface::class, SongRepository::class);
        App::bind(SingerRepositoryInterface::class, SingerRepository::class);
    }
}
