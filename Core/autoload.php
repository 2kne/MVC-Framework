<?php

/**
 * Autoload file
 *
 * PHP Version 7.2.15
 *
 * @category Autoload
 * @package  Autoload
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/autoload.php
 */

spl_autoload_register(
    function ($class) {

        if (strstr($class, 'Controller') && strlen($class) > strlen("Controller") ) {
            $class = str_replace("\\", "/", $class);
            $include = @include 'src/Controller/' . $class . '.php';

            if ($include == false) {
                include_once "src/View/Error/404.php";
                die();
            }
        } elseif (strstr($class, "Model")) {
            $class = str_replace("\\", "/", $class);
            $include = @include 'src/Model/' . $class . '.php';

            if ($include == false) {
                include_once "src/View/Error/404.php";
                die();
            }
        } else {
            $class = str_replace("\\", "/", $class);
            include $class . '.php';
        }
    }
);

?>