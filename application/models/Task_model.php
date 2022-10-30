<?php

class Task_model extends CI_Model {

  public function get_all_task() {
    $query = $this->db->get('task');

    return $query->result();
  }

  public function get_task_by_id( $id ) {
    $query = $this->db->get_where('task', ['id' => $id]);

    return $query->result();
  }

  public function create_task( $data ) {
    $this->db->insert('task', $data);

    if($this->db->affected_rows()) {
      return true;
    } else {
      return false;
    }
  }

  public function update_task( $data, $id ) {
    $data = [
      "category_id" => $data['category_id'],
      "title" => $data['title'],
      "description" => $data['description'],
      "start_date" => $data['start_date'],
      "finish_date" => $data['finish_date'],
      "status" => $data['status'],
    ];
    
    $this->db->update('task', $data, ['id' => $id]);

    if($this->db->affected_rows()) {
      return true;
    } else {
      return false;
    }
  }

  public function delete_task( $id ) {
    $this->db->delete('task', ['id' => $id]);

    if($this->db->affected_rows()) {
      return true;
    } else {
      return false;
    }
  }
}


?>