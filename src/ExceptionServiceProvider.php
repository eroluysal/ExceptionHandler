<?php

namespace QweB\Exception;

use Raven_Client as RavenClient;
use Bugsnag_Client as BugsnagClient;
use Illuminate\Support\ServiceProvider;

class ExceptionServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/exception.php' => config_path('exception.php'),
        ], 'exception');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerBugsnagClient();

        $this->registerSentryClient();

        $this->registerExceptionHandler();
    }

    /**
     * Register the sentry client.
     */
    protected function registerSentryClient()
    {
        $this->app->singleton('sentry', function ($app) {
            $config = $app['config']['exceptions.connections.sentry'];

            return new RavenClient(
                "https://{$config['public']}:{$config['secret']}@app.getsentry.com/{$config['project']}"
            );
        });
    }

    /**
     * Register the bugnsag client.
     */
    protected function registerBugsnagClient()
    {
        $this->app->singleton('bugsnag', function ($app) {
            $key = $app['config']['exception.connections.bugsnag.key'];

            return new BugsnagClient($key);
        });
    }

    /**
     * Register the exception handler provider.
     */
    protected function registerExceptionHandler()
    {
        $this->app->bindShared('QweB\Exception\Contracts\Exception', function ($app) {
            return new ExceptionManager($app);
        });
    }
}
