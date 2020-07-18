<?php

require_once('Database.php');

class CourseDataService
{
  public function __construct()
  {
    $this->database = new Database();
  }

  public function getCourse(string $code)
  {
    return [
      "id" => "TEST",
      "course_title" => "Example Title"
    ];

    // $query_course_id = "SELECT * FROM courses WHERE course_code=?";
    //$stmt = $this->database->prepare($query_course_id);
    // $stmt->bind_param('s', $course_code);
    // $stmt->execute();
    // $courses_result = $stmt->get_result();
    // $stmt->close();
    // $columns = mysqli_fetch_array($courses_result);
    // return $columns["course_id"];
  }

  public function getReviews(string $course_id)
  {
    return [[
      "name" => "A name",
      "professor" => "g.young",
      "textbook" => "some book",
      "grade" => "A++",
      "year" => 3,
      "take_again" => true,
      "review_comment" => "THis is a comment",
      "advice" => "Some advice?",
      "overall" => 3,
      "difficulty" => 4,
      "date" => date('m/d/Y h:i:s a', time())
    ], [
      "name" => "Some Name",
      "professor" => "g.young",
      "textbook" => "another book",
      "grade" => "F-",
      "year" => 3,
      "take_again" => true,
      "review_comment" => "THis is a comment",
      "advice" => "Some advice?",
      "overall" => 3,
      "difficulty" => 4,
      "date" => date('m/d/Y h:i:s a', time())
    ]];

    // $query_reviews = "SELECT * FROM reviews  WHERE course_id_fk=?";
    // $stmt = $this->database->prepare($query_reviews);
    // $stmt->bind_param('i', $course_id);
    // $stmt->execute();
    // $reviews_result = $stmt->get_result();
    // $stmt->close();

    // return $reviews;
  }

  public function getAgregates(string $course_id)
  {
    return [
      "total_overall" => 2.9,
      "difficulty" => 4.3,
      "num_take_again" => 4,
      "num_of_reviews" => 4
    ];
  }
}
