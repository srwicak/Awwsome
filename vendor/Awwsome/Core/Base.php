<?php

namespace Awwsome\Core;

class Base
{
    const VERSION = '0.1.0';

    public $config;
    protected static $co;

    public function __construct()
    {
        $this->config = new Config();

        //$this->config['app'] = $config->configCaching("app");
        //$this->config['database'] = $config->configCaching("database");

    }

    public function getAppConfig()
    {
        $this->config = $this->config->configCaching("app");
    }

    public function getDatabaseConfig()
    {}
}
