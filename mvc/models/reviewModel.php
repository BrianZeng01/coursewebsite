<?php 
require_once("../mvc/models/databaseConnection.php");

class reviewModel {

    function __construct()
    {
       $this->databaseConnection = new databaseConnection(); 
    }

    public function verifyCourse($courseId) {
        
        $query = "SELECT course_code,course_id FROM courses WHERE course_id=?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i',$courseId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();
        $stmt->close();

        if($result["course_code"] == "") {
            echo "not a course";
        }

        return $result;

    }
}