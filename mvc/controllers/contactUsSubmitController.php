<?php
require_once("../mvc/models/contactUsSubmitModel.php");
require_once("../mvc/views/contactUsSubmitView.php");

class contactUsSubmitController {

    function __construct()
    {
        $this->contactUsSubmitModel = new contactUsSubmitModel(); 
    }

    public function post() {

        $this->contactUsSubmitModel->submitFeedback($_POST);

        $view = new contactUsSubmitView();

        $view->render();
    }
}

$contactUsSubmitController = new contactUsSubmitController();

$contactUsSubmitController->post();