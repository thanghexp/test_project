<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        Validator::extend('strength', 'App\Http\CustomValidator@validateStrength');
        Validator::extend('check_exist_customer_type', 'App\Http\CustomValidator@check_exist_customer_type');
        Validator::extend('check_phone_or_fax_number', 'App\Http\CustomValidator@check_phone_or_fax_number');
        Validator::extend('check_postal_code', 'App\Http\CustomValidator@check_postal_code');
        Validator::extend('check_exist_customer_status', 'App\Http\CustomValidator@check_exist_customer_status');
        Validator::extend('check_exist_customer_contact', 'App\Http\CustomValidator@check_exist_customer_contact');



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
