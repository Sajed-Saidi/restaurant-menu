<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Schema::defaultStringLength(191);
        // Blade::withoutDoubleEncoding();

        // if (Setting::count() > 0) {
        //     $settings = Setting::first();
        // } else {
        //     $settings =  [
        //         "id" => "1",
        //         "website_name" => "Website",
        //         "email" => "website@gmail.com",
        //         "phone" => "+961 71 595 345",
        //         "address" => "Tyre, Lebanon",
        //         "meta_description" => "test",
        //         "meta_keywords" => "hello there",
        //         "logo" => "logo.png",
        //         "facebook_url" => "https://facebook.com/",
        //         "instagram_url" => "https://instagram.com/",
        //         "created_at" => "2024-12-05 19:34:08",
        //         "updated_at" => "2024-12-05 20:37:43"
        //     ];
        // }
        // View::share('settings', (object) $settings);
    }
}
