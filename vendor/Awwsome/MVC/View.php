<?php

namespace Awwsome\MVC;

class View
{
    protected $vars = array();
    protected $controller;
    protected $action;
    protected $special;

    public function __construct()
    {

    }

    public function setViewValues($controller, $action, $special)
    {
        $this->controller = $controller;
        $this->action = $action;
        $this->special = $special;
    }

    public function setValue($name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function renderView()
    {
        ($this->vars != null) ? extract($this->vars) : '';

        if ($this->special != null) {
            require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/app/views/' . $this->special . '.php';
        } else {
            if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/app/views/' .
                strtolower($this->controller) . '/' . strtolower($this->action) . '.php')) {
                return require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/app/views/' .
                    strtolower($this->controller) . '/' . strtolower($this->action) . '.php';
            } else {
                return require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/app/views/template/template.php';
            }
        }
    }
}
