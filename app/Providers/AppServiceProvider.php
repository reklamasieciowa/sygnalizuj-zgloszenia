<?php

namespace App\Providers;

use App\Entry;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Schema::defaultStringLength(191);

         Entry::deleted(function ($entry) {
            if ( !empty($entry->attachment) ) {
                if($entry->isForceDeleting()) {
                    Storage::delete($entry->attachment->file_name);
                    $entry->attachment->delete();
                }
            }
        });
    }
}
