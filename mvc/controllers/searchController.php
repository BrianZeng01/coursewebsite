<?php
require_once("../../mvc/models/searchModel.php");

class searchController {

    function __construct()
    {
        $this->searchModel = new searchModel();
    }

    public function post() {

        $this->searchModel->searchBar($_POST);
        
    }
}

$searchController = new searchController();

$searchController->post();