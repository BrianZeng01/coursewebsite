<?php 
require_once("../mvc/models/databaseConnection.php");

class reviewModel {

    function __construct()
    {
       $this->databaseConnection = new databaseConnection(); 
    }

}