<?php
require_once("../../mvc/models/databaseConnection.php");

class reportingModel
{

    function __construct()
    {
        $this->databaseConnection = new databaseConnection();
    }

    public function updateReport($user, $reviewId, $reportAction)
    {

        $query = "SELECT users_report FROM reviews WHERE review_id = ?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $reviewId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();
        $usersReport = $result["users_report"];

        if ($reportAction === "report" && strpos($usersReport, $user) === false) {

            $query = "UPDATE reviews SET reports = reports + 1,
     users_report = CONCAT(users_report, ',', ?) WHERE review_id =?";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('si', $user, $reviewId);

            $stmt->execute();
            $stmt->close();
        } else if ($reportAction === "removeReport" && strpos($usersReport, $user) !== false) {

            $user = ',' . $user;
            $query = "UPDATE reviews SET reports = reports - 1,
     users_report = REPLACE(users_report, ?, '') WHERE review_id =?";
            $stmt = $this->databaseConnection->prepare($query);
            $stmt->bind_param('si', $user, $reviewId);

            $stmt->execute();
            $stmt->close();
        }
    }
}
