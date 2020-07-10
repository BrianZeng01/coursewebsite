<?php

$host = "localhost";
$user = "root";
$pass = "Hostforme123.";
$db_name = "Coursecritics";

$connection = mysqli_connect($host, $user, $pass, $db_name);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = 'SELECT * FROM courses WHERE course_code="' . ($_GET["course"]) . '"';
$result = mysqli_query($connection, $query);

echo $_GET["as"];
if (mysqli_num_rows($result) == 0) {
    echo "not a course";
} else {
    echo "found";
}
