<?php

class Task_categories_model extends CI_Model {

  public function get_all_task_categories() {
    $query = $this->db->get('task_categories');

    return $query->result();
  }

  public function get_task_categories_by_id( $id ) {
    $query = $this->db->get_where('task_categories', ['id' => $id]);

    return $query->result();
  }

  public function create_task_categories( $data ) {
    $this->db->insert('task_categories', $data);

    if($this->db->affected_rows()) {
      return true;
    } else {
      return false;
    }
  }

  public function update_task_categories( $data, $id ) {
    $data = [
      "name" => $data['name'],
    ];
    
    $this->db->update('task_categories', $data, ['id' => $id]);

    if($this->db->affected_rows()) {
      return true;
    } else {
      return false;
    }
  }

  public function delete_task_categories( $id ) {
    $this->db->delete('task_categories', ['id' => $id]);

    if($this->db->affected_rows()) {
      return true;
    } else {
      return false;
    }
  }
}


?>