<?php
require_once("../mvc/models/databaseConnection.php");

class editReviewModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function verifyUserMadeThisReview($userId)
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
        $this->verifyUserMadeThisReview($result["user_id"]);

        $query = "SELECT course_code FROM courses WHERE course_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param("i", $result["course_id_fk"]);
        $stmt->execute();
        $courseCode = $stmt->get_result()->fetch_assoc()["course_code"];
        $stmt->close();

        $result["course_code"] = $courseCode;
        return $result;

    }
}
