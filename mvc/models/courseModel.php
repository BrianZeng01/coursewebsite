<?php
require_once("databaseConnect.php");

class courseModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
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

function test() {
    echo "test";
}