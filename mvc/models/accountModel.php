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

        for ($i = 0; $i < count($result); $i++) {
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

function editReviewAccountPage($reviewId)
{
    echo "<div class='edit'>
                    <div class='editBtn'>
                        <button type='button' title='Edit Review' onclick='editReview($reviewId)'>
                                <i class='far fa-edit fa-2x'></i>
                        </button>
                    </div>
                    <div class='deleteBtn'>
                        <button title='Delete Review' type='button' onclick='deleteConfirmation($reviewId,\"delete\");'>
                            <i class='far fa-trash-alt fa-2x'></i>
                        </button>
                    </div>
               </div>";
}