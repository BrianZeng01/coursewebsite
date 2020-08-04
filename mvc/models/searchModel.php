<?php
require_once("../../mvc/models/databaseConnection.php");

class searchModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function searchBar($post)
    {
        if ($post["searchAction"] == "courses") {
            if (isset($post["query"])) {
                $output = '';
                $input = $post["query"] . "%";
                $query = "SELECT course_code FROM courses WHERE course_code like ? LIMIT 30";
                $stmt = $this->databaseConnection->prepare($query);
                $stmt->bind_param('s', $input);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                $output = '<datalist id="datalist1">';

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $output .= '<option>' . $row["course_code"] . '</option>';
                    }
                }
                $output .= '</datalist>';
                echo $output;
            } else {
                return;
            }
        }
    }
}
