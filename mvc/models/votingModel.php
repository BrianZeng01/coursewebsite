<?php
require_once("../../mvc/models/databaseConnect.php");

class votingModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }


    public function updateVote($user, $reviewId, $voteAction)
    {
        if ($voteAction === "upvote") {

            $query = "UPDATE reviews SET votes = votes + 1,
     upvoters = CONCAT(upvoters, ',', ?) WHERE review_id =?";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('si', $user, $reviewId);

            $stmt->execute();
            $stmt->close();
        } elseif ($voteAction === "downvote") {

            $query = "UPDATE reviews SET votes = votes - 1,
     downvoters = CONCAT(downvoters, ',', ?) WHERE review_id =?";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('si', $user, $reviewId);

            $stmt->execute();
            $stmt->close();
        } elseif ($voteAction === "removeDownvote") {
            $user = ',' . $user;
            $query = "UPDATE reviews SET votes = votes + 1,
     downvoters = REPLACE(downvoters, ?, '') WHERE review_id =?";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('si', $user, $reviewId);

            $stmt->execute();
            $stmt->close();
        } else {

            $user = ',' . $user;
            $query = "UPDATE reviews SET votes = votes - 1,
    upvoters= REPLACE(upvoters, ?, '') WHERE review_id =?";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('si', $user, $reviewId);

            $stmt->execute();
            $stmt->close();
        }
    }
}
