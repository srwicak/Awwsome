<?php

namespace Awwsome\Database;

use Exception;

class ExceptionHandler extends Exception
{
    public function __construct()
    {
        parent::__construct();
    }
}