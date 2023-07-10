<?php

namespace App\Providers;

use Blade;
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

        Blade::directive('rupiah', function ($text) {
            return "Rp <?= number_format($text, 0, ',' , '.') ?>";
        });

        Blade::directive('berat', function ($berat) {
            if ($berat < 1000) {
                return "<?= $berat ?> gr";
            } else {
                return "<?= number_format(($berat / 1000), 0, ',' , '.') ?> kg";
            }
        });
    }
}
