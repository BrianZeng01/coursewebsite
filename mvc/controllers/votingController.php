<?php
require_once("../../mvc/models/votingModel.php");

class voting
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

$voting = new voting();
$voting->post($_POST["user"], $_POST["reviewId"], $_POST["voteAction"]);
