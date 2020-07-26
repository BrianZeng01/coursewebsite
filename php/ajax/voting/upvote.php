<?php
require "../../repetitiveCode/credentials.php";
if (isset($_POST["user"])) {
    $voter = $_POST["user"];
    $reviewId = $_POST["review_id"];

    
    $query = "UPDATE reviews SET votes = votes + 1,
     upvoters = CONCAT(upvoters, ',', ?) WHERE review_id =?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('si', $voter, $reviewId);
    
    $stmt->execute();
    $stmt->close();
}
$connection->close();
