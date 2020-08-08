<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/mvc/models/reviewModel.php";

class reviewController
{

    function __construct()
    {
        $this->reviewModel = new reviewModel();
    }

    function post()
    {
        $action = $_POST["action"];
        if ($action == "reviewBox") {
            $this->reviewModel->verifyCourseExists($_POST["courseId"], $action);
        } else if ($action == "insert") {
            $this->reviewModel->submitReview($_POST);
        } else if ($action == "editReviewBox") {
            $this->reviewModel->reviewExists($_POST["reviewId"], $action);
        } else if ($action == "update") {
            $this->reviewModel->updateReview($_POST, $action);
        } else if ($action == "delete") {
            $this->reviewModel->deleteReview($_POST, $action);
        } else if ($action == "report" || $action == "removeReport") {
            $this->reviewModel->updateReport($_POST["user"], $_POST["reviewId"], $_POST["action"]);
        } else {
            header("Location: https://coursecritics.test");
            exit;
        }
    }
}
$reviewController = new reviewController();
$reviewController->post();
