<?php

namespace QweB\Exception\Contracts;

use Exception as BaseException;

interface Exception
{
    /**
     * Report an exception.
     *
     * @param  \Exception  $e
     */
    public function report(BaseException $e);
}
