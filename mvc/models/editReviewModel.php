<?php
require_once("../mvc/models/databaseConnection.php");
require_once("../mvc/models/reviewModel.php");


class editReviewModel extends reviewModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function updateReview()
    {

        return;
    }

    public function verifyUser($userId)
    {
        
        if (!isset($_COOKIE["id"]) || $userId != $_COOKIE["id"]) {
            header("Location: https://coursecritics.test");
            exit;
        } else {
            return;
        }
    }

    public function reviewExists($reviewId)
    {
        if (!isset($reviewId["reviewId"])) {
            header("Location: https://coursecritics.test");
            exit;
        }
        $query = "SELECT * FROM reviews WHERE review_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param("i", $reviewId["reviewId"]);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        $this->verifyUser($result["user_id"]);

        return $result;

    }
}
