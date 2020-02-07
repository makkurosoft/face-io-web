<?php
class Model_attendance extends CI_Model{

    //出席を登録するメソッド
    public function insert_attendance(){
        $label_id = $this->input->post('label');
        $date = $this->input->post('date');

        $sql = "INSERT INTO Attendance(label_id, date) VALUES(?, ?)";

        $this->db->query($sql, array($label_id, $date));
    }


    //クラスごとの当日の出席状況を取得するメソッド
    public function get_attendance_statuses($class_id){
	  $sql = "
      SELECT attendance_number,
             name,
             FROM_UNIXTIME(出席時刻),
             ifnull(
               (CASE (出席時刻 < UNIX_TIMESTAMP(CURDATE() + INTERVAL 9 HOUR + INTERVAL 20 MINUTE))
                WHEN 1 THEN '出'
                WHEN 0 THEN '遅'
                END
               ), '欠') as 出欠判定
        FROM
            (SELECT Belongs.attendance_number, Student.name, Label.label_id
               FROM Belongs, Student, Label
              WHERE Belongs.class_id = ?
                AND Belongs.student_id = Student.student_id
                AND Belongs.student_id = Label.student_id) AS stu_info
            LEFT JOIN
            (SELECT label_id, MIN(date) as 出席時刻
               FROM Attendance
              WHERE date > UNIX_TIMESTAMP(CURDATE() + INTERVAL 6 HOUR)
              GROUP BY label_id) AS stu_atn
            ON stu_info.label_id = stu_atn.label_id;
";

	  $query = $this->db->query($sql, array($class_id));
	  return $query->result_array();
	}
}
 ?>
