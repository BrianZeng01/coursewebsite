<?php
require_once("../../mvc/models/votingModel.php");

class votingController
{

    function __construct()
    {
       $this->votingModel = new votingModel();   
    }
    public function post($user, $reviewId, $voteAction)
    {
        $this->votingModel->updateVote($user, $reviewId, $voteAction);

    }
}

$voting = new votingController();
$voting->post($_POST["user"], $_POST["reviewId"], $_POST["voteAction"]);
