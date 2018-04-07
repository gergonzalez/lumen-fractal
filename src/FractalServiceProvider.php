<?php

namespace Gergonzalez\Fractal;

use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;

class FractalServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        // $source_config = __DIR__.'/../../config/fractal.php';
        // $this->publishes([$source_config => 'config/fractal.php'], 'config');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $source_config = __DIR__.'/../config/fractal.php';
        $this->mergeConfigFrom($source_config, 'fractal');

        $this->app->singleton('fractal', function ($app) {

            // retrieves configurations

            $autoload = $app['config']->get('fractal.autoload');
            $input_key = $app['config']->get('fractal.input_key');
            $exclude_key = $app['config']->get('fractal.exclude_key');
            $serializer = $app['config']->get('fractal.serializer');

            // creating fractal manager instance
            $manager = new Manager();
            $factalNamespace = 'League\\Fractal\\Serializer\\';

            $loadSerializer = (class_exists($factalNamespace.$serializer)) ?
                $factalNamespace.$serializer : $serializer;

            $manager->setSerializer(new $loadSerializer());

            if ($autoload === true and $includes = $app['request']->input($input_key)) {
                $manager->parseIncludes($includes);
            }

            if ($app['request']->has($exclude_key)) {
                $manager->parseExcludes($app['request']->input($exclude_key));
            }

            return new Fractal($manager, $app['app']);
        });

        $this->app->alias('fractal', Fractal::class);

        // register our command here
        // $this->app->singleton('command.transformer.generate', function ($app) {
        //     return new TransformerGeneratorCommand($app['config'], $app['view'], $app['files'], $app);
        // });

        // $this->commands('command.transformer.generate');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['fractal'];

        // return ['fractal', 'command.transformer.generate'];
    }
}
