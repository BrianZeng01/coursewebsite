 <?php
    $host = "localhost";
    $user = "root";
    $pass = "Hostforme123.";
    $db_name = "Coursecritics";

    $connection = mysqli_connect($host, $user, $pass, $db_name);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if(isset($_POST["query"]))
    {
        $output = '';
        $query = "SELECT course_code FROM courses WHERE course_code like '" . $_POST["query"] . "%' LIMIT 30";
        // $_POST["query"]."%'";
        $result = mysqli_query($connection, $query);
        $existQuery = "SELECT * FROM courses WHERE course_code = ".$_POST["query"];
        $existResult = mysqli_query($connection, $existQuery);
        $output = '<datalist id="datalist1" class="list-unstyled">';

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $output .= '<option>'.$row["course_code"].'</option>';
            }
        }
        else
        {
            $output .= '<option>Course Not Found</option>';
        }
        $output .= '</datalist>';
        echo $output;
    }
    ?>