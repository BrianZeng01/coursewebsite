<?php
require_once("mvc/models/indexModel.php");
require_once("mvc/views/indexView.php");

class indexController {

    function __construct()
    {
       $this->indexModel = new indexModel(); 
    }

    public function get() {

        $view = new indexView();

        $view->render();
    }
}

$indexController = new indexController();

$indexController->get();