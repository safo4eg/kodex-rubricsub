<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach (glob(app_path('Filters') . '/*Filter.php') as $filename) {
            $namespace = 'App\\Filters\\' . basename($filename, '.php');
            $reflection = new \ReflectionClass($namespace);

            if($reflection->isAbstract()) continue;
            if($reflection->isInterface()) continue;
            if($reflection->isTrait()) continue;

            $this->app->bind(
                abstract: $namespace,
                concrete: fn(Application $application) => new $namespace(request()->query->all())
            );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::enablePasswordGrant();
    }
}
