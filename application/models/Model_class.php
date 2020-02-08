<?php
class Model_class extends CI_Model{

  //コンストラクタでデータベースライブラリをロード
  public function __construct(){
    $this->load->database();
  }

  //担当しているクラスの情報を取得するメソッド
  public function get_classes($staff_id){
    $sql = "SELECT class_id, department_name, grade, fiscal_year FROM ClassKBC JOIN Department ON ClassKBC.department_id=Department.department_id  WHERE class_id IN (SELECT class_id from Responsible where staff_id = ?) AND fiscal_year = (select YEAR(DATE_SUB(now(),INTERVAL 3 MONTH)))";
    $query = $this->db->query($sql, array($staff_id));
    return $query->result_array();
  }

  public function get_classname($class_id){
      $sql = "SELECT d.department_name, c.grade FROM ClassKBC c JOIN Department d ON c.department_id = d.department_id WHERE c.class_id = ?";
      $query = $this->db->query($sql, array($class_id));
      return $query->row();
  }

  public function get_student_list($class_id){
    $sql = "
        SELECT
          attendance_number,
          name,
          Label.label_id
          FROM Belongs, Label, Student
         WHERE Label.student_id = Belongs.student_id
           AND Student.student_id = Belongs.student_id
           AND  class_id = ?
     ";
    $query = $this->db->query($sql, array($class_id));
    return $query->result_array();
    }
}

  ?>
