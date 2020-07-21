<?php
require_once("../mvc/controllers/mainController.php");
require_once("../mvc/models/sameSubjectCodeModel.php");
require_once("../mvc/views/sameSubjectCodeView.php");

class sameSubjectCodeController extends controller {

    public function __construct()
    {
       $this->sameSubjectCodeModel = new sameSubjectCodeModel();
    }

    public function get() {
        $subjectCode = $_GET['courses'];
        $model = [];
        $model["text"] = $this->sameSubjectCodeModel->sameSubjectCode($subjectCode);
        $model["ratings"] = $this->sameSubjectCodeModel->getRatings($model["text"]);
        $view = new sameSubjectCodeView();

        $view->render($model);
        
    }
}

$subjectsController = new sameSubjectCodeController();

$subjectsController->get();