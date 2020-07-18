<?php
require_once('Controller.php');
require_once('Services/CourseService.php');
require_once('Views/CourseView.php');

class CourseController extends Controller implements iController
{
  public function __construct()
  {
    $this->course_service = new CourseService();
  }

  public function get()
  {
    $course_code = $_GET["course"];
    $model = $this->course_service->getCourse($course_code);

    $model['course_code'] = $course_code;

    $view = new CourseView();
    $view->render($model);
  }

  public function post()
  {
    echo 'Not supported';
  }
}

$controller = new CourseController();

$controller->route();
