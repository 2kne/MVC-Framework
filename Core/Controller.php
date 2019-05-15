<?php

/**
 * Controller file
 *
 * PHP Version 7.2.15
 *
 * @category Controller
 * @package  Controller
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/Controller.php
 */

/**
 * Class Controller
 *
 * File Controller.php
 *
 * @category Controller
 * @package  Controller
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/Controller.php
 */

class Controller
{
    protected static $_render;

    /**
     * La function render affiche les view
     *
     * @param string $view  la view
     * @param array  $scope c'est un tableau a extract
     *
     * @return void
     */
    protected function render($view, $scope = [])
    {
        extract($scope);
        $f = implode(
            DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View',
            str_replace('Controller', '', basename(get_class($this))), $view]
        ) . '.php';
        if (file_exists($f)) {
            ob_start();
            include $f;
            $view = ob_get_clean();
            ob_start();
            include implode(
                DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View',
                'index']
            ) . '.php';
            self::$_render = ob_get_clean();
        }
    }    
}