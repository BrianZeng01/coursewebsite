<?php
require_once("databaseConnection.php");

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

function voteState($review, $model)
{
    $votes = $review["votes"];
    if (isset($model["cookies"]["id"])) {

        $id = $review["review_id"];
        $upvoters = json_encode(explode(",", $review["upvoters"]));
        $downvoters = json_encode(explode(",", $review["downvoters"]));
        echo "<div class='vote'>";
        // <!-- Only !== false can be used due to return value of strpos -->
        if (strpos($review["upvoters"], $model["cookies"]["id"]) !== false) {

            echo "
                                                <input id='upvote$id' class='upvoted' 
                                                onclick='alreadyUpvoted()' type='image' src='../images/upvote.png' alt='Upvote' width='50px' /><br>
                                                <h2 id='votes$id' style='text-align:center;'>$votes</h2>
                                                <input id='downvote$id' class='null' 
                                                onclick='removeUpvote($votes,$id)' type='image' src='../images/downvote.png' alt='Downvote' width='50px' /><br>
                                                ";
        } elseif (strpos($review['downvoters'], $model["cookies"]["id"]) !== false) {

            echo "
                                                <input id='upvote$id' class='null' 
                                                onclick='removeDownvote($votes,$id)' type='image' src='../images/upvote.png' alt='Upvote' width='50px' /><br>
                                                <h2 id='votes$id' style='text-align:center;'>$votes</h2>
                                                <input id='downvote$id' class='downvoted' 
                                                onclick='alreadyDownvoted()' type='image' src='../images/downvote.png' alt='Downvote' width='50px' /><br>
                                                ";
        } else {
            echo "
                                                <input id='upvote$id' class='null' 
                                                onclick='upvote($votes,$id)' type='image' src='../images/upvote.png' alt='Upvote' width='50px' /><br>
                                                <h2 id='votes$id' style='text-align:center;'>$votes</h2>
                                                <input id='downvote$id' class='null' 
                                                onclick='downvote($votes,$id)' type='image' src='../images/downvote.png' alt='Downvote' width='50px' /><br>
                                                ";
        };
        echo "</div> </li>";
    } else {
        echo "
                                <div class='vote'>
                                    <input type='image' class='null' src='../images/upvote.png' alt='Upvote' width='50px' /><br>

                                    <h2 style='text-align:center;'>$votes</h2>

                                    <input type='image' class='null' src='../images/downvote.png' alt='Downvote' width='50px' />
                                </div>
                                </li>
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
                echo "<form action='editReview.php' method='POST'>
                        <input type='hidden' name='reviewId' value='$reviewId'>
                         <button id='makeReview' type='submit'>
                              Edit Review
                         </button>
                </form>";
                return;
            }
        }
        echo "<form action ='review.php' method='POST'>
                <input type='hidden' name='courseId' value='$courseId'>
                <button id='makeReview' type='submit'>
                     Write a Review
                </button>
            </form>";
    } else {
        echo '<button id="makeReview" type="button" onclick="notLoggedIn();">
                  Write a Review
              </button>
              <h4 id="notLoggedIn"></h4>
                        ';
    }
}
