<?php

require_once("databaseConnect.php");

class sameSubjectCodeModel
{

    public function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function sameSubjectCode($subjectCode)
    {
        $query = "SELECT * FROM courses JOIN subjects
 ON subjects.subject_id=courses.subject_id_fk
  WHERE subjects.subject_code = ?";

        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('s', $subjectCode);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $courses_array[] = $row;
        }

        return $courses_array;
    }

    public function getRatings($courses)
    {
        $ratings = [];
        foreach ($courses as $course) {
            $courseId = $course['course_id'];
            $query = "SELECT AVG(overall) 'overall', COUNT(*) 'count' FROM reviews WHERE course_id_fk=?";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('i', $courseId);
            $stmt->execute();
            $res = $stmt->get_result();
            $stmt->close();
            $r = mysqli_fetch_array($res);
            $reviewCount = round($r["count"]);
            if ($reviewCount != 0) {
                $overall = number_format((float)round($r["overall"], 1), 1, '.', '');
            } else {
                $overall = "0.0";
            }

            array_push($ratings, ["overall" => $overall, "reviewCount" => $reviewCount]);
        }

        return $ratings;
    }
}
