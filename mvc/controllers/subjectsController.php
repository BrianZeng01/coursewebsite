<?php
require_once("../mvc/controllers/mainController.php");
require_once("../mvc/models/subjectsModel.php");
require_once("../mvc/views/subjectsView.php");

class subjectsController extends controller {

    public function __construct()
    {
       $this->subjectsModel = new subjectsModel;
    }

    public function get() {
        $model = $this->subjectsModel->getAllSubjects();

        $view = new subjectView();
        $view->render($model);
        
    }
}

$subjectsController = new subjectsController();

$subjectsController->get();