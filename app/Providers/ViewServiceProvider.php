<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;

class ViewServiceProvider extends ServiceProvider
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
        $this->app->singleton('IntlMoneyFormatter', function () {
            return new IntlMoneyFormatter(
                new NumberFormatter('es_AR', NumberFormatter::CURRENCY),
                new ISOCurrencies
            );
        });

        $this->app->singleton('MoneyFormatter', function () {
            return new class {
                public function format($value) {
                    $fiver = Money::ARS($value * 100);
                    return app('IntlMoneyFormatter')->format($fiver);
                }
            };
        });
    }
}
