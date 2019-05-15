<?php

class UserController extends Controller
{
    public function __construct($view = "index")
    {
        $this->render($view);
        echo self::$_render;
        $request = new Request($_POST, $_GET);
    }

    public function add()
    {
        echo "Je suis add";
    }

    public function index($ko="ok")
    {
        echo "Je suis ".$ko." indexAction";
    }

    public function registerAction()
    {
        Request::getQueryParamS($_POST);

        // $register = new UserModel();
        // $register->setEmail($_POST['mail']);
        // $register->setPassword($_POST['pass']);
        // $register->save();
    }

    public function loginAction()
    {
        $login = new UserModel();
        $login->setEmail($_POST['mail']);
        $login->setPassword($_POST['pass']);
        $login->login();
    }
}