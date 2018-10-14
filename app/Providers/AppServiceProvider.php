<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Channel;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $channels = Channel::with(['shows' => function($q) {
            $q->with('seasons');
        }])->get();

        view()->composer('layout', function($view) use ($channels) {
            $view->with('channelsMenu', $channels);
        });
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\IShowRepository', 'App\Repositories\ShowRepository');
        $this->app->bind('App\Interfaces\IChannelRepository', 'App\Repositories\ChannelRepository');
        $this->app->bind('App\Interfaces\ICommentRepository', 'App\Repositories\CommentRepository');
        $this->app->bind('App\Interfaces\IRatingRepository', 'App\Repositories\RatingRepository');
        $this->app->bind('App\Interfaces\IUserRepository', 'App\Repositories\UserRepository');
    }
}
