<?php
require_once("../mvc/models/databaseConnection.php");
require_once("../mvc/models/reviewModel.php");


class editReviewModel extends reviewModel{

    function __construct()
    {
       $this->databaseConnection = new databaseConnection();
    
    }

    public function updateReview( ) {

        return;
    }
}