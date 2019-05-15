<?php

class AppController extends Controller
{
    public function __construct($view = "index")
    {
        $this->render($view);
        echo self::$_render;
        $request = new Request($_POST, $_GET);
    }

    public function add()
    {
        echo "Je suis add app";
    }

    public function index()
    {
        echo "Je suis indexAction app";
    }
}