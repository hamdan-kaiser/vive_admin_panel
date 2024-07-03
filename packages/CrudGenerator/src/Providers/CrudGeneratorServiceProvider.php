<?php

namespace Hashibul\CrudGenerator\Providers;

use Hashibul\CrudGenerator\Commands\MasterLayoutPublish;
use Hashibul\CrudGenerator\Commands\TemplateAssetPublish;
use Illuminate\Support\ServiceProvider;

class CrudGeneratorServiceProvider  extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/route.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'crud-generator');
        $this->loadViewsFrom(__DIR__.'/../../resources/stub-templates', 'stub-templates');
        $this->loadViewsFrom(__DIR__.'/../../resources/stubs', 'stubs');

        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('crud-generator')
        ], 'crud-generator');

        $this->commands([
            MasterLayoutPublish::class,
            TemplateAssetPublish::class,
        ]);
    }
}
