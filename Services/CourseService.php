<?php

require_once("CourseDataService.php");

class CourseService {

  private $course_data_service;

  function __construct(){
    $this->course_data_service = new CourseDataService();
  }

  public function getCourse(string $code){
    
    $course = $this->course_data_service->getCourse($code);

    $reviews = $this-> course_data_service->getReviews($course["id"]);

    $aggregate = $this->course_data_service->getAgregates($course["id"]);

    return [
      "course" => $course,
      "reviews" => $reviews,
      "aggregates" => $aggregate
    ];
  }

}
