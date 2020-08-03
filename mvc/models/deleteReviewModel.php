<?php
require_once("../mvc/models/databaseConnection.php");
require_once("../mvc/models/editReviewModel.php");

class deleteReviewModel extends editReviewModel{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection(); 
    }

    public function deleteReview($reviewId) {

        $courseId = $this->getCourseId($reviewId);
        $courseCode = $this-> getCourseCode($courseId);

        $query = "DELETE FROM reviews WHERE review_id=? AND user_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('ii', $reviewId, $_COOKIE["id"]);
        $stmt->execute();
        $stmt->close();


        header("Location: https://coursecritics.test/php/course.php?course=$courseCode");
        exit;
    }

    public function getCourseId($reviewId) {
        $query = "SELECT course_id_fk FROM reviews WHERE review_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $reviewId);
        $stmt->execute();
        $courseId = $stmt->get_result()->fetch_assoc()["course_id_fk"];
        $stmt->close();

        return $courseId;
 
    }

    public function getCourseCode($courseId) {
        $query = "SELECT course_code FROM courses WHERE course_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $courseId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();
        $courseCode = $result["course_code"];
        $stmt->close();

        return $courseCode;

    }
}