<?php

namespace Awwsome\Core;

class Config
{
    private $config = array();

    public function configCaching($name)
    {
        if (!isset($this->config[$name])) {
            $array = require_once ROOT . '/app/config/' . $name . '.php';
            $this->config[$name] = $array;
            return $array;
        } else {
            return $this->config[$name];
        }
    }
}
