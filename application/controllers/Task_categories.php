<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Task_categories extends RestController {
  public function __construct() {
    parent::__construct();
    $this->load->model('task_categories_model');
  }

  public function index_get($id = null) {

    if ( $id ) {
      $result = $this->task_categories_model->get_task_categories_by_id($id);

      if ( !$result ) {
        $this->response([
          'status' => 404,
          'message' => "The id doesn't exist"
        ], 404);
      }
    } else {
      $result = $this->task_categories_model->get_all_task_categories();

       if ( !$result ) {
        $this->response([
          'status' => 400,
          'message' => "Failed to get task categories data"
        ], 400);
      }
    }

    if ( $result ) {
      $this->response([
        'status' => 200,
        'message' => 'Success to get task categories data',
        'data' => $result,
      ], 200); 
    }
  }

  public function index_post() {
    $data = $this->post();
    $result = $this->task_categories_model->create_task_categories($data);

    if ( $result ) {
      $this->response([
        'status' => 200,
        'message' => "Success to create new task categories",
      ], 200); 
    } else {
      $this->response([
        'status' => 400,
        'message' => "Failed to create new task categories"
      ], 400);
    }
  }

  public function index_put() {
    $data = $this->put();
    $id = $data['id'];

    $result = $this->task_categories_model->update_task_categories($data, $id);

    if ( $result ) {
      $this->response([
        'status' => 200,
        'message' => "Success to update task categories",
      ], 200); 
    } else {
      $this->response([
        'status' => 400,
        'message' => "Failed to update task categories"
      ], 400);
    }
  }

  public function index_delete( $id = null ) {

    if ( $id ) {
      $result = $this->task_categories_model->delete_task_categories($id);

      if ( $result ) {
        $this->response([
          'status' => 200,
          'message' => "Success to delete task categories",
        ], 200); 
      } else {
        $this->response([
          'status' => 400,
          'message' => "Failed to delete task categories or id doesn't exist"
        ], 400);
      }
    }
  }
}
?>