<?php


namespace Laravel\Guards;

use Illuminate\Support\ServiceProvider;
use Laravel\Guards\Commands\InstallGuardCommand;

class GuardsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallGuardCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../config/guards.php' => config_path('guards.php'),
        ], 'guards-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/guards.php',
            'guards'
        );
    }
}
