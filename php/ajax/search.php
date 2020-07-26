 <?php
    require '../repetitiveCode/credentials.php';

    if (isset($_POST["query"])) {
        $output = '';
        $input = $_POST["query"] . "%";
        $query = "SELECT course_code FROM courses WHERE course_code like ? LIMIT 30";
        $stmt = $connection->prepare($query);
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
    }
    $connection->close();
    ?>
