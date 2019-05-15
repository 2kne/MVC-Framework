<?php
/**
 * Request file
 *
 * PHP Version 7.2.15
 *
 * @category Request
 * @package  Request
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/Request.php
 */

/**
 * Class Request
 *
 * File Request.php
 *
 * @category Request
 * @package  Request
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/Core/Request.php
 */
class Request
{
    private $_post;
    private $_get;

    /**
     * La function __construct set les variables prive
     *
     * @param array $post tableau de post
     * @param array $get  tableau de get
     *
     * @return void
     */
    public function __construct($post, $get)
    {
        $this->setPost($this->getQueryParams($post));
        $this->setGet($this->getQueryParams($get));
    }

    /**
     * La function getQueryParams retire les espaces
     *
     * @return $_POST
     */
    public static function getQueryParams()
    {
        foreach ($_POST as $key => $value) {
            $value = stripcslashes(trim(htmlspecialchars($value)));
            $value = str_replace(" ", "", $value);
            $_POST[$key] = $value;
        }
        var_dump($_POST);
        return $_POST;
    }

    /**
     * La function setPost est un setter
     *
     * @param array $post tableau de post
     *
     * @return void
     */
    public function setPost($post)
    {
        $this->_post = $post;
    }

    /**
     * La function setGet est un setter
     *
     * @param array $get tableau de get
     *
     * @return void
     */
    public function setGet($get)
    {
        $this->_get = $get;
    }

    /**
     * La function getPost est un getter
     *
     * @param array $post tableau de post
     *
     * @return post
     */
    public function getPost($post)
    {
        return $this->_post;
    }

    /**
     * La function getPost est un getter
     *
     * @param array $get tableau de get
     *
     * @return get
     */
    public function getGet($get)
    {
        return $this->_get;
    }
}