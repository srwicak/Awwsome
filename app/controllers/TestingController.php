<?php

class TestingController extends \Awwsome\MVC\Controller
{
    public function index()
    {
        parent::renderView();
        echo "<br>";
        parent::loadModel();
    }

    public function load()
    {
        parent::renderView();
        echo "<br>";
        parent::loadModel();
    }
}