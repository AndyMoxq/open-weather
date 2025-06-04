<?php

namespace ThankSong\OpenWeather\Providers;

use Illuminate\Support\ServiceProvider;
use ThankSong\OpenWeather\OpenWeather;

class OpenWeatherServiceProvider extends ServiceProvider{
    public function boot(){
        $this->publishes([
            __DIR__.'/../../config/openweather.php' => config_path('openweather.php'),
        ], 'openweather');
        
    }

    public function register(){
        $this->mergeConfigFrom(
            __DIR__.'/../../config/openweather.php',
            'openweather'
        );
        $this->app->singleton('weather', fn() => new OpenWeather);
    }
}