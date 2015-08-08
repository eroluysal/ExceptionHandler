<?php

namespace QweB\Exception;

use Bugsnag_Client as BugsnagClient;
use Illuminate\Support\ServiceProvider;
use Raven_Client as RavenClient;

class ExceptionServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/exception.php' => config_path('exception.php'),
        ], 'exception');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBugsnagClient();

        $this->registerSentryClient();

        $this->registerExceptionHandler();
    }

    /**
     * Register the sentry client.
     *
     * @return void
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
     *
     * @return void
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
     *
     * @return void
     */
    protected function registerExceptionHandler()
    {
        $this->app->bindShared('QweB\Exception\Contracts\Exception', function ($app) {
            return new ExceptionManager($app);
        });
    }
}
