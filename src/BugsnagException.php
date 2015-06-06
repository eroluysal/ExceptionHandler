<?php namespace QweB\Exception;

use Bugsnag_Client as Bugsnag;
use Exception as BaseException;
use QweB\Exception\Contracts\Exception as ExceptionContract;

class BugsnagException implements ExceptionContract {

	/**
	 * Bugsnag Client instance.
	 *
	 * @var \Bugsnag_Client
	 */
	protected $bugsnag;

	/**
	 * Create a new Bugsnag exception intance.
	 *
	 * @param  \Bugsnag_Client  $bugsnag
	 * @return void
	 */
	public function __construct(Bugsnag $bugsnag)
	{
		$this->bugsnag = $bugsnag;
	}

	/**
	 * Report an exception.
	 *
	 * @param  \Exception $e
	 * @return void
	 */
	public function report(BaseException $e)
	{
		$this->bugsnag->notifyException((string) $e);
	}

}
