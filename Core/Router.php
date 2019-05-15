<?php
/**
 * Router file
 *
 * PHP Version 7.2.15
 *
 * @category Router
 * @package  Router
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/Router.php
 */

/**
 * Class Router
 *
 * File Router.php
 *
 * @category Router
 * @package  Router
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/Router.php
 */
class Router
{
    private static $_routes;

    /**
     * La function connect permet le routage statique
     *
     * @param string $url   c'est l'url
     * @param route  $route tableau
     *
     * @return void
     */
    public static function connect($url, $route)
    {
        self::$_routes[$url] = $route;
    }

    /**
     * La function get recupere l'url et la traite
     *
     * @param string $url url
     *
     * @return $tab_url
     */
    public static function get($url)
    {
        $tab_url = [];
        $url = str_replace(BASE_URI, "", $url);
        if (strstr($url, "?", true)!=false) {
            $url2 = strstr($url, "?", true);
            $url3 = strstr($url, "?");
        } else {
            $url2 = $url;
        }

        if ($url2 == true) {
            foreach (self::$_routes as $key => $value) {
                $key1 = explode('/', $key);
                $url_test = explode('/', $url2);

                if ($key == $url2) {
                    $tab_url["controller"] = $value['controller'];
                    $tab_url["action"] = $value['action'];
                } elseif (count($key1) == count($url_test)) {
                    $match = self::compare($url_test, $key1);

                    if ($match == true) {
                         $tab_url["controller"] = $value['controller'];
                         $tab_url["action"] = $value['action'];
                    }
                } 
            }
        }

        if (!empty($_GET)) {
            $tab_url["param"] = $_GET;
        }
        return $tab_url;

    }

    /**
     * La function compare oriente vers la bonne route
     *
     * @param array $url    tableau de l'url
     * @param array $routes tableau de la route
     *
     * @return $match
     */
    public static function compare($url, $routes)
    {
        $nb1 = 0;
        $nb2 = 0;
        $pointeur = 0;
        $p = 0;
        $p1 = 0;
        $match = false;
        $tab_para_final = [];
        $tab_tmp = [];
        $tab_tmp_val = [];
        $verif = 1;
        foreach ($routes as $value) {
            if (preg_match('/{/', $value)== false) {
                $nb1++;
            } else {
                array_push($tab_tmp, $value);
            }
            $test = strpos($value, '{');
                    
            if ($test != false && $verif == 1) {
                $p1 = $p;
                $verif = 2;
            }
            $p++;
        }
        $p = 0;

        foreach ($url as $value) {
            if ($nb2 == $nb1) {
                $match = true;
                foreach ($url as $value) {
                    if ($p >= $nb1) {
                        
                        $_GET[$routes[$p]] = $value;    
                    }
                    $p++;
                }
            }
            $p=0;

            if ($value == $routes[$pointeur]) {
                $nb2++;
            }
            $pointeur++;        
        }
        return $match;
    }
}