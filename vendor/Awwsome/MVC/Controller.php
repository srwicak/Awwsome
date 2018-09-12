<?php

namespace Awwsome\MVC;

use Awwsome\Core\UrlFetcher;

abstract class Controller
{
    private $config;
    protected $view;
    protected $controller;
    protected $action;
    protected $url;

    public function __construct()
    {
        $this->config = new \Awwsome\Core\Config();
        $this->config = $this->config->configCaching("app");
        $this->view = new View();
        //$this->controller = $urlFetcher->getController();
        //$this->action = $urlFetcher->getAction();
        //return $this->controller;
    }

    public function loadModel()
    {
        $url = new UrlFetcher();
        var_dump($url->getController());
        $modelFile = "a";
        //require_once dirname(dirname(dirname(dirname(__FILE__)))) .
        //    '/app/models/' . $modelFile . 'Model.php';
        //new $modelFile();
    }

    public function renderView($path = null, $special = null)
    {
        $this->controller = a;
        if (($path == null) && ($special == null)) {
            $viewFolder = get_called_class();
            $viewFolder = rtrim($viewFolder, "Controller") . 'View';
            $viewFile = "file";
            echo "$viewFolder/$viewFile";
        } else if (($path != null) && ($special == null)) {
            $path = explode('/', $path);
            $viewFolder = $path[0];
            $viewFile = $path[1];
            $this->view->setViewValues(
                $viewFolder,
                $viewFile,
                $special = null
            );
        } else if (($path == null) && ($special != null)) {
            $this->view->setViewValues(
                $viewFolder = null,
                $viewFile = null,
                $special
            );
        } else {
            die("Don't use path and special parameter together. Please choose one of them.");
        }
    }

    public function setValue($name, $value)
    {
        $this->view->setValue($name, $value);
    }

    public function __destruct()
    {
        $this->view->renderView();
    }
}