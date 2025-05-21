<?php

namespace Spits\LaravelOpenproviderApi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelOpenproviderApiServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        parent::boot();
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-openprovider-api')
            ->hasConfigFile('openprovider-api');
    }
}
