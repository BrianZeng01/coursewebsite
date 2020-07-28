<?php
require_once("../../mvc/models/databaseConnection.php");

class votingModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }


    public function updateVote($user, $reviewId, $voteAction)
    {
        $query = "SELECT upvoters,downvoters FROM reviews WHERE review_id = ?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $reviewId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();
        $upvoters = $result["upvoters"];
        $downvoters = $result["downvoters"];

        if ($voteAction === "upvote" && strpos($upvoters, $user) === false) {

            $query = "UPDATE reviews SET votes = votes + 1,
     upvoters = CONCAT(upvoters, ',', ?) WHERE review_id =?";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('si', $user, $reviewId);

            $stmt->execute();
            $stmt->close();
        } elseif ($voteAction === "downvote" && strpos($downvoters, $user) === false) {

            $query = "UPDATE reviews SET votes = votes - 1,
     downvoters = CONCAT(downvoters, ',', ?) WHERE review_id =?";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('si', $user, $reviewId);

            $stmt->execute();
            $stmt->close();
        } elseif ($voteAction === "removeDownvote" && strpos($downvoters, $user) !== false) {
            $user = ',' . $user;
            $query = "UPDATE reviews SET votes = votes + 1,
     downvoters = REPLACE(downvoters, ?, '') WHERE review_id =?";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('si', $user, $reviewId);

            $stmt->execute();
            $stmt->close();
        } else {
            if (strpos($upvoters, $user) === false) {
                return;
            }

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
