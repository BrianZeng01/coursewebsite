<?php
require_once("databaseConnection.php");

class reviewModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function verifyCourseExists($courseId, $action)
    {

        $query = "SELECT course_id FROM courses WHERE course_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $courseId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();
        $stmt->close();


        if ($result["course_id"] == "") {
            if ($action == "reviewBox") {
                echo "<h1>Sorry, something went wrong!</h1>";
                exit;
            } else if ($action == "insert") {
                $this->failedVerification();
            }
        } else {
            return $this->verifyUserHasNoReview($courseId, $action);
        }
    }

    // public function verifyReview($review, $action)
    // {
    //     if ($action == "insert") {
    //         $this->verifyUserHasNoReview($review["courseId"]);
    //         $this->verifyCourseExists($review["courseId"]);
    //         $this->verifyReviewInputs($review);
    //         $this->submitReview($review);
    //     } else if ($action == "update") {
    //         $userId = true;
    //         $courseId = true;
    //         $this->verifyReviewInputs($review);
    //         $this->updateReview($review);
    //     }
    // }

    public function verifyReviewInputs($review, $courseIdBoolean)
    {
        $scores = [1, 2, 3, 4, 5];
        $textbooks = ["Required", "Recommended", "Not Required"];
        $grades = ["A+", "A-", "A", "B+", "B", "B-", "C+", "C", "C-", "D", "F", "Rather Not Say", "N/A"];
        $years = range(1970, date("Y"));
        $regex = "/^[a-zA-Z]*[\s]?[a-zA-Z]*$/";

        if (
            $courseIdBoolean == 0 || !in_array($review["overall"], $scores) || !in_array($review["difficulty"], $scores) ||
            !in_array($review["textbook"], $textbooks) || !in_array($review["grade"], $grades) ||
            !in_array($review["year"], $years) || !preg_match($regex, $review["professor"]) ||
            30 < strlen($review["professor"])
        ) {
            $this->failedVerification();
        }
    }

    public function verifyUserHasNoReview($courseId, $action)
    {
        $query = "SELECT user_id FROM reviews WHERE course_id_fk=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $courseId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        if ($action == "reviewBox") {
            if (!isset($_COOKIE["id"])) {
                echo "<h2>You've already written a Review</h2>";
            }

            foreach ($result as $user) {
                if ($_COOKIE["id"] == $user["user_id"]) {
                    echo "<h2>You've already written a Review</h2>";
                }
            }

            require_once("../../php/repetitiveCode/commonHTML/reviewInputs.php");
            exit;
        } else if ($action == "insert") {
            if (!isset($_COOKIE["id"])) {
                return false;
            }
            foreach ($result as $user) {
                if ($_COOKIE["id"] == $user["user_id"]) {
                    return false;
                }
            }
            return true;
        }
    }


    public function submitReview($review)
    {
        $courseIdBoolean = $this->verifyCourseExists($review["courseId"], "insert");
        $courseCode = $this->getCourseCode($review["courseId"]);
        $this->verifyReviewInputs($review, $courseIdBoolean);

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

        $query = "INSERT INTO reviews (difficulty,overall,grade,professor,textbook,anonymous,
        take_again,review_comment,advice,year,user_id,user_first_name,course_id_fk)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param(
            "iisssiississi",
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
            $_COOKIE["id"],
            $_COOKIE["name"],
            $review["courseId"]
        );
        $stmt->execute();
        $stmt->close();

        header("Location: https://coursecritics.test/php/course.php?course=$courseCode");
        exit;
    }

    public function failedVerification()
    {
        header("Location: https://coursecritics.test");
        exit;
    }

    public function getCourseCode($courseId)
    {
        $query = "SELECT course_code FROM courses WHERE course_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $courseId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();
        $stmt->close();

        return $result["course_code"];
    }
}
