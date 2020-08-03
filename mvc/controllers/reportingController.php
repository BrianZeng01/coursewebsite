<?php
require_once("../../mvc/models/reportingModel.php");

class reportingController {
    
    function __construct()
    {
       $this->reportingModel = new reportingModel();

    }

    public function post(){
        $this->reportingModel->updateReport($_POST["user"], $_POST["reviewId"], $_POST["reportAction"]);
    }
}

$reportingController = new reportingController();

$reportingController->post();