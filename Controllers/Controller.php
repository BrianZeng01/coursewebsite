<?php


interface iController
{
  public function get();
  public function post();
}

class Controller
{
  public function route()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->post();
      return;
    }
    $this->get();
  }

  protected function render_json($content)
  {
    header('Content-Type: application/json');
    echo json_encode($content);
  }
}
