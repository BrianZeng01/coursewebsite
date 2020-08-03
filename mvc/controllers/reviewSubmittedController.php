<?php
require_once("../mvc/models/reviewSubmittedModel.php");

class reviewSubmittedController {

    function __construct()
    {
        $this->reviewSubmittedModel = new reviewSubmittedModel();
    }

    public function post() {
        $this->reviewSubmittedModel->verifyReview($_POST);
    }
}

$reviewSubmittedController = new reviewSubmittedController();

$reviewSubmittedController->post();