<?php
require_once("../mvc/models/reviewEdittedModel.php");

class reviewEdittedController {

    function __construct()
    {
        $this->reviewEdittedModel = new reviewEdittedModel();
        

    }

    public function post() {
        
        $this->reviewEdittedModel->verifyReview($_POST, "update");

    }
}

$reviewEdittedController = new reviewEdittedController();

$reviewEdittedController->post();