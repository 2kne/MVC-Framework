<?php

/**
 * Routes file
 *
 * PHP Version 7.2.15
 *
 * @category Routes
 * @package  Routes
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/routes.php
 */

Router::connect('/', ['controller' => 'app', 'action' => 'index']);
Router::connect('/user', ['controller' => 'app', 'action' => 'index']);
Router::connect('/POL', ['controller' => 'user', 'action' => 'index']);
Router::connect('/register', ['controller' => 'user', 'action' => 'registerAction']);
Router::connect('/login', ['controller' => 'user', 'action' => 'loginAction']);
Router::connect(
    '/PIPI/{id}/{nom}', ['controller' => 'Pol', 'action' => 'CyrilAction']
);
Router::connect(
    '/PIPI/ok/{id}/{nom}', ['controller' => 'Pol', 'action' => 'LouisAction']
);