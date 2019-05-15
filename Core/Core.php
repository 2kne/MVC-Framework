<?php

/**
 * Core file
 *
 * PHP Version 7.2.15
 *
 * @category Core
 * @package  Core
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/Core.php
 */

namespace Core;

/**
 * Class Core
 *
 * File Core.php
 *
 * @category Core
 * @package  Core
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/Core.php
 */


class Core
{
    /**
     * La function render affiche les view
     *
     * @return void
     */
    public function run()
    {
        include_once "routes.php";

        $tab = \Router::get($_SERVER['REQUEST_URI']);

        if (!empty($tab['param']) && isset($tab['controller'])
            && !empty($tab['action'])
        ) {

            $control = ucfirst($tab["controller"]);
            $methode = $tab["action"];
            $param = $tab["param"];
            $control = ucfirst($control . "Controller");
            $a = new $control();
            $a->$methode($param);
        } elseif (!empty($tab) && empty($tab['param'])) {

            $control = ucfirst($tab["controller"]) . "Controller";
            $methode = $tab["action"];    
            $a = new $control();
            $a->$methode();
        } else {
            include_once "src/View/Error/404.php";
            die();
        }
    }

    /**
     * La function render affiche les view
     *
     * @param string $url c'est l'url
     *
     * @return void
     */
    public function initClass($url)
    {
        $url = explode("/", $url);
        $t = count($url) - 1;
        if ($t > 3) {
            $ctrl = ucfirst($url[2]. "Controller");
            $method = $url[3];
            $a = new $ctrl;
            if (method_exists($a, $method)) {
                $a->$method();
            } else {
                include_once "src/View/Error/404.php";
                die();
            }
        } elseif ($t > 2) {
            $ctrl = ucfirst($url[2] . "Controller");
            $method = "indexAction";
            if (class_exists($ctrl)) {
                $a = new $ctrl;
                $a->$method();
            }
        } elseif ($t > 1) {
            $ctrl = "AppController";
            $method = "index";
            $a = new $ctrl();
            $a->$method();
        }
    }
}