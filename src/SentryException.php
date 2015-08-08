<?php

namespace QweB\Exception;

use Exception as BaseException;
use QweB\Exception\Contracts\Exception as ExceptionContract;
use Raven_client as RavenClient;

class SentryException implements ExceptionContract
{
    /**
     * Create a Sentry exception instance.
     *
     * @param \Raven_Client $raven
     *
     * @return void
     */
    public function __construct(RavenClient $raven)
    {
        $this->raven = $raven;
    }

    /**
     * Report an exception.
     *
     * @param \Exception $e
     *
     * @return void
     */
    public function report(BaseException $e)
    {
        $this->raven->captureException($e);
    }
}
