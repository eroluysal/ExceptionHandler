<?php

namespace QweB\Exception;

use Exception as BaseException;
use Psr\Log\LoggerInterface;
use QweB\Exception\Contracts\Exception as ExceptionContract;

class LogException implements  ExceptionContract
{
    /**
     * The log implementation.
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $log;

    /**
     * Create a new LogException instance.
     *
     * @param \Psr\Log\LoggerInterface $log
     *
     * @return void
     */
    public function __construct(LoggerInterface $log)
    {
        $this->log = $log;
    }

    /**
     * Report an exception.
     *
     * @param \Exception $e
     *
     * @return string
     */
    public function report(BaseException $e)
    {
        $this->log->error((string) $e);
    }
}
