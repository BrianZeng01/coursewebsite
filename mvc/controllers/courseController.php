<?php
require_once("../mvc/models/courseModel.php");
require_once("../mvc/views/courseView.php");
require_once("../mvc/controllers/mainController.php");

class courseController extends controller {

    function __construct()
    {
       $this->courseModel = new courseModel();
    }

    function get()
    {
        $courseCode = $_GET['course'];
        

        $model = [];
        $model["cookies"] = $_COOKIE;
        $model["course"] = $this->courseModel->getCourse($courseCode);
        $courseId = $model["course"]["course_id"];
        $model["reviews"] = $this->courseModel->getReviews($courseId);
        $model["aggregates"] = $this->courseModel->getAggregates($courseId);

        $view = new courseView();
        $view->render($model);
        $this->courseModel->close();
    }

}

$courseController = new courseController();

$courseController->get();
