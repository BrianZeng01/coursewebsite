<?php
require "../../repetitiveCode/credentials.php";
if (isset($_POST["user"])) {
    $reviewId = $_POST["review_id"];
    $downvoters = $_POST["downvoters"];

    if (strtok($downvoters, ",") === $_POST["user"]) {
       $voter = $_POST["user"];
    } else {
       $voter = "," . $_POST["user"];
    }
    $query = "UPDATE reviews SET votes = votes + 1,
     downvoters = REPLACE(downvoters, ?, '') WHERE review_id =?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('si', $voter, $reviewId);
    
    $stmt->execute();
    $stmt->close();
}
$connection->close();
