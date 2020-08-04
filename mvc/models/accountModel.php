<?php
require_once("../mvc/models/databaseConnection.php");
require_once("../mvc/models/courseModel.php");

class accountModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function getAccountReviews()
    {
        if (!isset($_COOKIE["id"])) {
            header("Location: https://coursecritics.test");
            exit;
        }

        $query = "SELECT * FROM reviews WHERE user_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param("s", $_COOKIE["id"]);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        for ($i=0; $i<count($result); $i++) {
            $result[$i]["course_code"] = $this->getCourseCode($result[$i]["course_id_fk"]);
        }
        return $result;
    }

    public function getCourseCode($courseId)
    {

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

function editReviewAccountPage($reviewId) {
        echo "<div class='edit'>
                <form action='editReview.php' method='POST'>
                    <input type='hidden' name='reviewId' value='$reviewId'>
                    <button title='Edit Review'><i class='far fa-edit fa-2x'></i></button>
                </form>
                <form id='deleteReview$reviewId' action='deleteReview.php' method='POST'>
                    <input type='hidden' name='reviewId' value='$reviewId'>
                    <button title='Delete Review' type='button'
                     onclick='if(confirm(\"Are you sure you want to Delete this Review?\"))
                     {document.getElementById(\"deleteReview$reviewId\").submit()}'><i class='far fa-trash-alt fa-2x'></i></button>
                </form>
               </div>";
}