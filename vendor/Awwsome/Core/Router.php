<?php

namespace Awwsome\Core;

class Router
{
    private $config;
    private $urlController = null;
    private $urlAction = null;
    private $urlFragments = array();
    private $urlCount;

    public function __construct()
    {
        $this->config = new Config();
        $this->config = $this->config->configCaching("app");
        $urlFetcher = new UrlFetcher();
        $this->urlController = $urlFetcher->getController();
        $this->urlAction = $urlFetcher->getAction();
        $this->urlFragments = $urlFetcher->getFragments();
        $this->urlCount = $urlFetcher->getCount();
        $this->urlRouting();
    }
/*
    public function urlFragmentation()
    {
        if (isset($_GET['url'])) {
            //$url = ucfirst($_GET['url']);
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->urlCount = count($url);

            foreach ($url as $path) {
                $this->urlFragments[] = ucfirst($path);
            }

            $this->urlController = (isset($this->urlFragments[0]) ?
                $this->urlFragments[0] : null);
            $this->urlAction = (isset($this->urlFragments[1]) ?
                $this->urlFragments[1] : null);

            //TODO: testing area
            echo "Router.php<br>URL :";
            var_dump($url);
            echo "<br>";
            echo "URL Count :";
            var_dump($this->urlCount);
            echo "<br>";
            echo "URL Controller :";
            var_dump($this->urlController);
            echo "<br>";
            echo "URL Action :";
            var_dump($this->urlAction);
            echo "<br>";
            echo "URL Fragments :";
            var_dump($this->urlFragments);
            echo "<hr>";
            //end
        }
    }
*/
    public function urlRouting()
    {
        if (file_exists(ROOT . '/app/controllers/' .
            $this->urlController . 'Controller.php')) {
            require_once ROOT . '/app/controllers/' .
                $this->urlController . 'Controller.php';
            $controller = '\\' . $this->urlController . 'Controller';
            new $controller;

            if (method_exists($this->urlController . 'Controller',
                $this->urlAction)) {
                $urlParams = array();
                for ($i = 2; $i < $this->urlCount; $i++) {
                    $urlParams[] = $this->urlFragments[$i];
                }
                if (is_callable(array($this->urlController . 'Controller',
                    $this->urlAction)))
                    $handle = array($this->urlController . 'Controller',
                        $this->urlAction);
            } else if (!isset($this->urlAction)) {
                $handle = array($this->urlController . 'Controller',
                    "index");
                $urlParams = null;
            } else {
                /**
                 * TODO: buat keputusan (method)!
                 * sisa dari metoda yang ada dan metoda yang tidak diset adalah
                 * metode yang salah maka lebih baik masuk laman 404 atau langsung
                 * ke index dari controller?
                 */
                die('TODO: buat keputusan (method)!');
            }
        } else if (!isset($this->urlController)) {
            $this->urlController = $this->config['defaultController'];
            if ($this->urlController == "HomeController") {
                require_once ROOT . '/app/controllers/HomeController.php';
                new \HomeController();
            } else {
                require_once ROOT . '/app/controllers/' .
                    $this->urlController . 'Controller.php';
            }
            $handle = array($this->urlController, "index");
            $urlParams = null;
        } else {
            /**
             * TODO: buat keputusan (controller)!
             * Jika file kelas tidak ada dan bukan tidak diset maka lebih baik
             * masuk ke index atau ke laman 404?
             * bagus juga masuk ke:
             * $this->urlController = $this->config['page404'];
             * kemudian di cek value dari 404pagenya apakah AwwsomeDefault
             * yaitu apakah file 404.php di folder template, jika bukan maka
             * cukup di call saja sesuai dengan keinginan pengguna
             */
            $handle = null;
            $urlParams = null;
            echo "<hr><h2>GAK ADA!</h2>";
        }
        if (($urlParams == null) && ($handle != null)) {
            call_user_func($handle);
        } else if (($urlParams != null) && ($handle != null)) {
            call_user_func_array($handle, $urlParams);
        }
    }
}
