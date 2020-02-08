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

  // 出席履歴用の日付一覧を取得する
  public function get_dates($limit = NULL){
    if($limit === NULL){
      $limit = 30;
    }
    $sql = "
    SELECT (CURDATE() - INTERVAL (@seq_no := 0) DAY) AS dates
     UNION
    SELECT (CURDATE() - INTERVAL (@seq_no := ( @seq_no + 1)) DAY) AS dates
      FROM Attendance
     LIMIT 30;
    ";

    $query = $this->db->query($sql);
	  return $query->result_array();
  }

  // 一日あたりのクラスの出席状況一覧を取得する
  public function get_one_data($label_id){
    $sql = "
      SELECT
        day_info.dates,
        ifnull(
          (CASE attendance_5.atd
           BETWEEN UNIX_TIMESTAMP(DATE(FROM_UNIXTIME(attendance_5.atd)) + INTERVAL 6 HOUR)
            AND
           UNIX_TIMESTAMP(DATE(FROM_UNIXTIME(attendance_5.atd)) + INTERVAL 9 HOUR + INTERVAL 20 MINUTE)
           WHEN 1 THEN '出'
           WHEN 0 THEN '遅'
           END
          ), '欠') as 出欠判定
        FROM
            (SELECT
               (CURDATE() - INTERVAL (@seq_no:= 0) DAY) AS dates UNION SELECT (CURDATE() - INTERVAL (@seq_no:= ( @seq_no + 1)) DAY)
               FROM Attendance
              LIMIT 30
            ) AS day_info
            LEFT JOIN
            (SELECT DATE_FORMAT(FROM_UNIXTIME(date), '%Y-%m-%d') AS dates,
                    MIN(date) AS atd
               FROM Attendance
              WHERE label_id = ?
              GROUP BY (FROM_UNIXTIME(date, '%Y-%m-%d'))
            ) AS attendance_5
                ON day_info.dates = attendance_5.dates
        -- 月曜~金曜のみ表示
       -- WHERE DAYOFWEEK(day_info.dates) BETWEEN 2 AND 6
       ORDER BY day_info.dates DESC;
       ";
    $query = $this->db->query($sql, array($label_id));
	  return $query->result_array();
  }
}
 ?>
