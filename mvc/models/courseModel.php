<?php
require_once("../mvc/models/databaseConnection.php");

class courseModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function closeConnection()
    {
        $this->databaseConnection->closeConnection();
    }
    public function getCourse($courseCode)
    {
        $query = "SELECT * FROM courses WHERE course_code=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('s', $courseCode);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_array(MYSQLI_ASSOC);
    }


    public function getReviews($courseId)
    {

        $query = "SELECT * FROM reviews 
WHERE course_id_fk=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $courseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    public function getAggregates($courseId)
    {

        $query = "SELECT AVG(overall) 'average_overall',
AVG(difficulty) 'average_difficulty',SUM(take_again=1) 'num_take_again'
 FROM reviews WHERE course_id_fk=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('s', $courseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $array = $result->fetch_array(MYSQLI_ASSOC);
        $array["average_overall"] = number_format((float) round($array["average_overall"], 1), 1, '.', '');
        $array["average_difficulty"] = number_format((float) round($array["average_difficulty"], 1), 1, '.', '');

        return $array;
    }
}

function voteState($review)
{
    $votes = $review["votes"];
    if (isset($_COOKIE["id"])) {

        $id = $review["review_id"];
        echo "<div class='vote'>";
        // <!-- Only !== false can be used due to return value of strpos -->
        if (strpos($review["upvoters"], $_COOKIE["id"]) !== false) {

            echo "
                    <i id='upvote$id' class='fas fa-caret-up fa-3x upvoted' onclick='alreadyUpvoted()'></i>
                    <h2 id='votes$id'>$votes</h2>
                    <i id='downvote$id' class='fas fa-caret-down fa-3x null' onclick='removeUpvote($votes,$id)'></i>
                    ";
        } elseif (strpos($review['downvoters'], $_COOKIE["id"]) !== false) {

            echo "
                    <i id='upvote$id' class='fas fa-caret-up fa-3x null' onclick='removeDownvote($votes,$id)'></i>
                    <h2 id='votes$id'>$votes</h2>
                    <i id='downvote$id' class='fas fa-caret-down fa-3x downvoted' onclick='alreadyDownvoted()'></i>
                    ";
        } else {
            echo "
                    <i id='upvote$id' class='fas fa-caret-up fa-3x null' onclick='upvote($votes,$id)'></i>
                    <h2 id='votes$id'>$votes</h2>
                    <i id='downvote$id' class='fas fa-caret-down fa-3x null' onclick='downvote($votes,$id)'></i>
                 ";
        };
        echo "</div>";
    } else {
        echo "
                                <div class='vote'>
                                     <i class='fas fa-caret-up fa-3x null'></i>
                                    <h2>$votes</h2>
                                     <i class='fas fa-caret-down fa-3x null'></i>
                                </div>
                                ";
    }
}
function reviewState($model)
{
    $courseId = $model["course"]["course_id"];

    if (isset($model["cookies"]["id"])) {
        foreach ($model["reviews"] as $review) {
            $reviewId = $review["review_id"];
            if ($model["cookies"]["id"] == $review["user_id"]) {
                echo "
                         <button id='writeReview' type='button' onclick='editReview($reviewId)'>
                              Edit Review
                         </button>
                ";
                return;
            }
        }
        echo "
                <button id='writeReview' type='button' onclick='writeReview($courseId)'>
                     Write a Review
                </button>
            ";
    } else {
        echo '<button id="writeReview" type="button" onclick="notLoggedIn();">
                  Write a Review
              </button>
              <h4 id="notLoggedIn"></h4>
                        ';
    }
}

function editOrFlagReview($review)
{
    if (!isset($_COOKIE["id"])) {
        return;
    }

    if ($review["user_id"] == $_COOKIE["id"]) {
        editReview($review["review_id"]);
        return;
    } else {
        flagReview($review["review_id"], $review["users_report"]);
        return;
    }
}



function editReview($reviewId)
{
    echo"
    <div class='reviewBottom'>
        <div class='edit'>
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
        </div>
    </div>
        ";
}

function flagReview($reviewId, $usersReport)
{

    if (strpos($usersReport, $_COOKIE["id"]) !== false) {
        echo "<div class='flag'>
            <button id='flag$reviewId' type='button' class='reported' title='Remove Report' onclick='report($reviewId, \"removeReport\");'><i class ='fas fa-flag fa-2x'></i></button>
        </div>";
    } else {
        echo "<div class='flag'>
            <button id='flag$reviewId' type='button' class='notReported' title='Report Review' onclick='report($reviewId, \"report\");'><i class ='fas fa-flag fa-2x'></i></button>
        </div>";
    }
}
