<?php
require_once("../mvc/models/contactUsSubmitModel.php");

class contactUsSubmitController
{

    function __construct()
    {
        $this->contactUsSubmitModel = new contactUsSubmitModel();
    }

    public function post()
    {
        $this->contactUsSubmitModel->submitFeedback($_POST);
    }
}

$contactUsSubmitController = new contactUsSubmitController();

$contactUsSubmitController->post();