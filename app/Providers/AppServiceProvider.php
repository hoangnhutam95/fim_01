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
use App\Repositories\Lyric\LyricRepository;
use App\Repositories\Lyric\LyricRepositoryInterface;
use App\Repositories\Album\AlbumRepository;
use App\Repositories\Album\AlbumRepositoryInterface;
use App\Repositories\Rate\RateRepository;
use App\Repositories\Rate\RateRepositoryInterface;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Favorite\FavoriteRepository;
use App\Repositories\Favorite\FavoriteRepositoryInterface;
use App\Repositories\View\ViewRepository;
use App\Repositories\View\ViewRepositoryInterface;

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
        App::bind(LyricRepositoryInterface::class, LyricRepository::class);
        App::bind(AlbumRepositoryInterface::class, AlbumRepository::class);
        App::bind(RateRepositoryInterface::class, RateRepository::class);
        App::bind(CommentRepositoryInterface::class, CommentRepository::class);
        App::bind(FavoriteRepositoryInterface::class, FavoriteRepository::class);
        App::bind(ViewRepositoryInterface::class, ViewRepository::class);
    }
}
