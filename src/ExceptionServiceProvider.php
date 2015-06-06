<?php namespace QweB\Exception;

use Bugsnag_Client as Bugsnag;
use Illuminate\Support\ServiceProvider;

class ExceptionServiceProvider extends ServiceProvider {

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/config/exception.php' => config_path('exception.php')
		], 'exception');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerBugsnagClientProvider();

		$this->registerExceptionHandler();
	}

	/**
	 * Register the bugnsag client.
	 *
	 * @return void
	 */
	protected function registerBugsnagClientProvider()
	{
		$this->app->singleton('bugsnag', function($app)
		{
			$key = $app['config']['exception.connections.bugsnag.key'];

			return new Bugsnag($key);
		});
	}

	/**
	 * Register the exception handler provider.
	 *
	 * @return void
	 */
	protected function registerExceptionHandler()
	{
		$this->app->bindShared('QweB\Exception\Contracts\Exception', function($app)
		{
			return new ExceptionManager($app);
		});
	}

}
