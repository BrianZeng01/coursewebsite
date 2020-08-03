<?php
require_once("../../mvc/models/votingModel.php");

class votingController
{

    function __construct()
    {
       $this->votingModel = new votingModel();   
    }
    public function post()
    {
        $this->votingModel->updateVote($_POST["user"], $_POST["reviewId"], $_POST["voteAction"]);

    }
}

$voting = new votingController();
$voting->post();
