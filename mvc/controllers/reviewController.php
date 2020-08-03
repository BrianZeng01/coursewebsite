<?php
require_once("../mvc/models/reviewModel.php");
require_once("../mvc/views/reviewView.php");

class reviewController {

    function __construct()
    {
       $this->reviewModel = new reviewModel(); 
    }

    function post() {
        $courseId = $_POST["courseId"];
        $model = $this->reviewModel->verifyCourseExists($courseId);
        
        $view = new reviewView();
        $view->render($model);
        
    }
}

$reviewController = new reviewController();
$reviewController->post();