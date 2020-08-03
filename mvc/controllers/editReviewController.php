<?php
require_once("../mvc/models/editReviewModel.php");
require_once("../mvc/views/editReviewView.php");

class editReviewController
{

    function __construct()
    {
        $this->editReviewModel = new editReviewModel();
    }

    public function post()
    {
        
        $model = $this->editReviewModel->reviewExists($_POST);

        $view = new editReviewView();
        $view->render($model);
    }
}

$editReviewController = new editReviewController();

$editReviewController->post();
