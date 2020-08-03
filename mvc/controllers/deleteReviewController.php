<?php
require_once("../mvc/models/deleteReviewModel.php");

class deleteReviewController {

    function __construct()
    {
        $this->deleteReviewModel = new deleteReviewModel(); 
    }

    public function post() {

        $this->deleteReviewModel->reviewExists($_POST);
        $this->deleteReviewModel->deleteReview($_POST["reviewId"]);
    }
}

$deleteReviewController = new deleteReviewController();
$deleteReviewController->post();