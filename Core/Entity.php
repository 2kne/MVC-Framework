<?php
/**
 * Entity file
 *
 * PHP Version 7.2.15
 *
 * @category Entity
 * @package  Entity
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/Entity.php
 */

/**
 * Class Entity
 *
 * File Core.php
 *
 * @category Entity
 * @package  Entity
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/Core.php
 */
class Entity
{
    /**
     * La function render affiche les view
     *
     * @param array $tab le tableau des variables a cree
     *
     * @return void
     */
    public function __construct($tab)
    {
        foreach ($tab as $key => $value) {
            $this->$key = $value;
        }
    }
}