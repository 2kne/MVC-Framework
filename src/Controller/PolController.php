<?php

class PolController extends Controller
{
    public function __construct($view = "index")
    {
        $this->render($view);
        echo self::$_render;
    }

    public function CyrilAction()
    {
        echo "POL > CYRIL";
    }

    public function LouisAction()
    {
        echo "Louis";
    }
}