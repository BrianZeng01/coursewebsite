<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/mvc/models/reviewModel.php";

class reviewController {

    function __construct()
    {
       $this->reviewModel = new reviewModel(); 
    }

    function post() {
        $action = $_POST["action"];
        if ($action == "reviewBox") {
        $courseId = $_POST["courseId"];
        $this->reviewModel->verifyCourseExists($courseId, $action);
        } else if($action == "insert") {
            $this->reviewModel->submitReview($_POST);
        }
        
        
    }
}
$reviewController = new reviewController();
$reviewController->post();