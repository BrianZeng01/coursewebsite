<?php
require_once("../mvc/models/accountModel.php");
require_once("../mvc/views/accountView.php");

class accountController {

    function __construct()
    {
        $this->accountModel = new accountModel();
        
    }

    public function get() {

        $model = $this->accountModel->getAccountReviews();
        
        $view = new accountView();
        $view->render($model);
    }
}

$accountController = new accountController();

$accountController->get();