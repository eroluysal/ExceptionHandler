<?php namespace QweB\Exception;

use Bugsnag_Client as Bugsnag;
use Illuminate\Support\Manager;
use Raven_Client as RavenClient;

class ExceptionManager extends Manager {

	/**
	 * Create an instance of the Log Exception driver.
	 *
	 * @return \QweB\Exception\Contracts\Exception
	 */
	protected function createLogDriver()
	{
		return new LogException($this->app['log']);
	}

	/**
	 * Create an instance of the Bugsnag Exception driver.
	 *
	 * @return \QweB\Exception\Contracts\Exception
	 */
	protected function createBugsnagDriver()
	{
		return new BugsnagException($this->app['bugsnag']);
	}

	/**
	 * Create an instance of the Sentry Exception driver.
	 *
	 * @return \QweB\Exception\Contracts\Exception
	 */
	protected function createSentryDriver()
	{
		$config = $this->getConfig('sentry');

		$raven = new RavenClient(
			"https://{$config['public']}:{$config['secret']}@app.getsentry.com/{$config['project']}"
		);

		return new SentryException($raven);
	}

	/**
	 * Get the default driver name.
	 *
	 * @return string
	 */
	public function getDefaultDriver()
	{
		return $this->app['config']['exception.driver'];
	}

	/**
	 * Get the exception connection configuration.
	 *
	 * @param  string  $name
	 * @return array
	 */
	protected function getConfig($name)
	{
		return $this->app['config']["exception.connections.{$name}"];
	}

}
