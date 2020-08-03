<?php
require_once("../mvc/models/databaseConnection.php");
require_once("../mvc/models/reviewSubmittedModel.php");

class reviewEdittedModel extends reviewSubmittedModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function updateReview($review)
    {
        
        $courseCode = $this->reviewExists($review);

        if (isset($review["anonymous"])) {
            $anonymous = 1;
        } else {
            $anonymous = 0;
        }
        if (isset($review["takeAgain"])) {
            $takeAgain = 1;
        } else {
            $takeAgain = 0;
        }
        if (rtrim($review["professor"]) == "") {
            $professor = "N/A";
        } else {
            $professor = $review["professor"];
        }
        if ($review["advice"] == "") {
            $advice = "None";
        } else {
            $advice = $review["advice"];
        }

        $query = "UPDATE reviews SET difficulty=?, overall=?, grade=?, professor=?,
         textbook=?, anonymous=?, take_again=?, review_comment=?, advice=?, year=?
        WHERE review_id=?;";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param(
            "iisssiissii",
            $review["difficulty"],
            $review["overall"],
            $review["grade"],
            $professor,
            $review["textbook"],
            $anonymous,
            $takeAgain,
            $review["comment"],
            $advice,
            $review["year"],
            $review["reviewId"]
        );
        $stmt->execute();
        $stmt->close();

        header("Location: https://coursecritics.test/php/course.php?course=$courseCode");
        exit;

    }

    // Below 2 functions taken from editReviewModel and slightly changed
    //, possibly refactor to reduce repeition
    public function verifyUserMadeThisReview($userId)
    {

        if (!isset($_COOKIE["id"]) || $userId != $_COOKIE["id"]) {
            header("Location: https://coursecritics.test");
            exit;
        } else {
            return;
        }
    }

    public function reviewExists($review)
    {
        if (!isset($review["reviewId"])) {
            header("Location: https://coursecritics.test");
            exit;
        }
        $query = "SELECT * FROM reviews WHERE review_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param("i", $review["reviewId"]);
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

        return $courseCode;
    }
}
