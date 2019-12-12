<?php
class Model_attendance extends CI_Model{

    public function insert_attendance(){
        $label_id = $this->input->post('label');
        $date = $this->input->post('date');

        $sql = "INSERT INTO Attendance(label_id, date) VALUES(?, ?)";

        $this->db->query($sql, array($label_id, $date));
    }

}
 ?>
