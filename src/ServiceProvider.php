<?php

namespace Gimmersta\PdfLibHelper;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/pdflib-helper.php', 'pdflib-helper'
        );
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/pdflib-helper.php' => config_path('pdflib-helper.php'),
        ]);
    }
}
