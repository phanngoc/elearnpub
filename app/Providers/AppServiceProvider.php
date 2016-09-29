<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('*', 'App\Http\ViewComposers\CssViewComposer');
      view()->composer('*', 'App\Http\ViewComposers\BookViewComposer');

      Validator::extend('greater_than_field', function($attribute, $value, $parameters, $validator) {
        $min_field = $parameters[0];
        $data = $validator->getData();
        $min_value = $data[$min_field];
        return $value > $min_value;
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
