<?php
require_once("../mvc/models/databaseConnection.php");

class reviewSubmittedModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function verifyReview($review)
    {
        $verifiedUser = $this->verifyUser($_COOKIE["id"]);
        $verifiedCourse = $this->verifyCourse($review["courseId"]);

        $scores = [1, 2, 3, 4, 5];
        $textbooks = ["Required", "Recommended", "Not Required"];
        $grades = ["A+", "A-", "A", "B+", "B", "B-", "C+", "C", "C-", "D", "F", "Rather Not Say", "N/A"];
        $years = range(1970, date("Y"));
        $regex = "/^[a-zA-Z]+[\s]?[a-zA-Z]*$/";

        if (
            !$verifiedUser || !$verifiedCourse || !in_array($review["overall"], $scores) || !in_array($review["difficulty"], $scores) ||
            !in_array($review["textbook"], $textbooks) || !in_array($review["grade"], $grades) ||
            !in_array($review["year"], $years) || !preg_match($regex, $review["professor"]) ||
            31 < strlen($review["professor"]) || strlen($review["professor"]) < 2
        ) {
            $this->failedVerification();
        } else {
            $this->submitReview($review);
        }
    }

    public function verifyUser($user)
    {
        return true;
    }

    public function verifyCourse($courseId)
    {

        $query = "SELECT course_code,course_id FROM courses WHERE course_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $courseId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();
        $stmt->close();

        if ($result["course_code"] == "") {
            return false;
        } else {
            return true;
        }
    }


    public function submitReview($review)
    {
        print_r($review);
        echo "verified";
    }
    public function failedVerification()
    {
        return;
    }
}
