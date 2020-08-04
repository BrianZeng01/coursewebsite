<?php
require_once("../mvc/views/contactUsView.php");

class contactUsController {

    function __construct()
    {
        $view = new contactUsView(); 

        $view->render();
    }
}

$contactUsController = new contactUsController();