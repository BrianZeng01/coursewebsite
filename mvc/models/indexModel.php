<?php
require_once("mvc/models/databaseConnection.php");

class indexModel {

    function __construct()
    {
        $this->databaseConnection = new databaseConnection(); 
    }
}