<?php

namespace Awwsome\Core;

class UrlFetcher
{
    private $urlController;
    private $urlAction;
    private $urlFragments = array();
    private $urlCount;

    public function __construct()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->urlCount = count($url);

            foreach ($url as $path) {
                $this->urlFragments[] = ucfirst($path);
            }
        }
    }

    public function getController()
    {
        return $this->urlController = (isset($this->urlFragments[0])) ?
            $this->urlFragments[0] : null;
    }

    public function getAction()
    {
        return $this->urlAction = (isset($this->urlFragments[1])) ?
            $this->urlFragments[1] : null;
    }

    public function getFragments()
    {
        return $this->urlFragments;
    }

    public function getCount()
    {
        return $this->urlCount;
    }
}