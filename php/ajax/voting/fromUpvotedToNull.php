<?php
require "../../repetitiveCode/credentials.php";
if (isset($_POST["user"])) {
    $upvoters = $_POST["upvoters"];
    $reviewId = $_POST["review_id"];

    if (strtok($upvoters, ",") === $_POST["user"]) {
       $voter = $_POST["user"];
    } else {
       $voter = "," . $_POST["user"];
    }

    $query = "UPDATE reviews SET votes = votes - 1,
    upvoters= REPLACE(upvoters, ?, '') WHERE review_id =?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('si', $voter, $reviewId);
    
    $stmt->execute();
    $stmt->close();
}
$connection->close();
