<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends RestController {
  public function __construct() {
    parent::__construct();
    $this->load->model('task_model');
  }

  public function index_get($id = null) {

    if ( $id ) {
      $result = $this->task_model->get_task_by_id($id);

      if ( !$result ) {
        $this->response([
          'status' => 404,
          'message' => "The id doesn't exist"
        ], 404);
      }
    } else {
      $result = $this->task_model->get_all_task();

       if ( !$result ) {
        $this->response([
          'status' => 400,
          'message' => "Failed to get task data"
        ], 400);
      }
    }

    if ( $result ) {
      $this->response([
        'status' => 200,
        'message' => 'Success to get task data',
        'data' => $result,
      ], 200); 
    }
  }

  public function index_post() {
    $data = $this->post();
    $result = $this->task_model->create_task($data);

    if ( $result ) {
      $this->response([
        'status' => 200,
        'message' => "Success to create new task",
      ], 200); 
    } else {
      $this->response([
        'status' => 400,
        'message' => "Failed to create new task"
      ], 400);
    }
  }

  public function index_put() {
    $data = $this->put();
    $id = $data['id'];

    $result = $this->task_model->update_task($data, $id);

    if ( $result ) {
      $this->response([
        'status' => 200,
        'message' => "Success to update task",
      ], 200); 
    } else {
      $this->response([
        'status' => 400,
        'message' => "Failed to update task"
      ], 400);
    }
  }

  public function index_delete( $id = null ) {

    if ( $id ) {
      $result = $this->task_model->delete_task($id);

      if ( $result ) {
        $this->response([
          'status' => 200,
          'message' => "Success to delete task",
        ], 200); 
      } else {
        $this->response([
          'status' => 400,
          'message' => "Failed to delete task or id doesn't exist"
        ], 400);
      }
    }
  }
}
?>