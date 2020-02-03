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
      $sql = "SELECT
      Belongs.attendance_number,
      Student.name,
      FROM_UNIXTIME(MIN(Attendance.date)),
      ifnull( CASE MIN(Attendance.date) < UNIX_TIMESTAMP(CURDATE() + INTERVAL 9 HOUR + INTERVAL 20 MINUTE) WHEN 1 THEN '出' WHEN 0 THEN '遅' END, '欠') as 出欠判定
      FROM Attendance
      RIGHT JOIN Label ON Attendance.label_id = Label.label_id
      RIGHT JOIN Belongs ON Label.student_id = Belongs.student_id
      LEFT JOIN Student ON Belongs.student_id = Student.student_id
      WHERE (date BETWEEN
        UNIX_TIMESTAMP(CURDATE() + INTERVAL 6 HOUR)
        AND
        UNIX_TIMESTAMP(CURDATE() + INTERVAL 23 HOUR + INTERVAL 59 MINUTE + INTERVAL 59 SECOND)
        OR date IS NULL)
        AND Belongs.class_id = ?
        GROUP BY Belongs.attendance_number, Student.name";
        $query = $this->db->query($sql, array($class_id));
        return $query->result_array();
      }

}
 ?>
