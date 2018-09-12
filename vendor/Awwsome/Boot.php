<?php

namespace Awwsome;

use Awwsome\Core\Loader;
use Awwsome\Core\Router;

final class Boot
{
    private static $mode;

    final public function __consturct()
    {

    }

    final public static function start($mode = null)
    {
        if (!defined('AWWSOME_BASE'))
            define('AWWSOME_BASE', dirname(__FILE__));

        require_once AWWSOME_BASE . '\Core\Loader.php';

        $loader = new Loader();

        $loader->addNamespace('Awwsome\\', 'vendor/Awwsome');

        new Router();

        if ($mode === null) {
            static::$mode = 0;
        } else if (($mode === 1) || ($mode === 0)) {
            static::$mode = $mode;
        } else {
            die('Please choose 0, 1, or leave null for mode parameter!');
        }

        define('AWWSOME_MODE', static::$mode);
        //TODO:testing
        echo "Boot.php<br>AWWSOME_MODE: " . AWWSOME_MODE . "<hr>";
        //end
    }
}
