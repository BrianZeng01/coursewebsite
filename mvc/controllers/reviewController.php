<?php
require_once("../mvc/models/reviewModel.php");
require_once("../mvc/views/reviewView.php");

class reviewController {

    function __construct()
    {
       $this->reviewModel = new reviewModel(); 
    }

    function get() {
        $course = $_GET["course"];
        $courseId = $_GET["courseId"];
        
        $view = new reviewView();
        $view->render($course,$courseId);
        
    }
}

$reviewController = new reviewController();
$reviewController->get();