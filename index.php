<?php

/**
 * Routes file
 *
 * PHP Version 7.2.15
 *
 * @category Index.php
 * @package  Index.php
 * @author   Louis Guiraudie <louis.guiraudie@epitech.eu>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost/PiePHP/index.php
 */

define(
    'BASE_URI', str_replace(
        '\\', '/', substr(
            __DIR__,
            strlen($_SERVER['DOCUMENT_ROOT'])
        )
    )
);
require_once implode(DIRECTORY_SEPARATOR, ['Core', 'autoload.php']);
$app = new Core\Core();
$app->run();
/*$app->initClass($_SERVER['REQUEST_URI']);
Router::connect("/",  ['controller' => 'app', 'action' => 'index']);
print_r(Router::get($_SERVER['REQUEST_URI']));*/
/*$a = new ORM();
$b = new ArticleModel($a->read('article', 1));
$g = $a->read('article', 1);
var_dump($b->article);
foreach ($g as $key => $value) {
    echo $key;
}
echo"<pre>";
var_dump($g);
echo "\n\n\n\n";
var_dump($a->find('article',array('WHERE' => ['nom'=>'news'],
'ORDER BY' => 'id ASC','LIMIT' => ''), $b->getRelation()));
echo "</pre>"*/
/*$a->find("users", array(
'WHERE' => ['id'=>'2'],'ORDER BY' => 'id ASC','LIMIT' => ''));*/
/*Request::getQueryParamS();*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>index</title>
</head>
<body>
    <pre><?php var_dump($_POST) ?></pre>
    <pre><?php var_dump($_GET) ?></pre>
    <pre><?php var_dump($_SERVER) ?></pre>
    <?php
    $layout = new UserController("register");?>
</body>
</html>