<?php
class Model_teacher extends CI_Model{

    //コンストラクタでデータベースライブラリをロード
    public function __construct(){
        $this->load->database();
    }

    //ユーザ名とパスワードの照合
    public function signin($user_name, $password){
        $data = array(
            'user_name' => $user_name,
            'password' => md5($password)
        );

        $query = $this->db->get_where('StaffAccount', $data);

        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }

    //ユーザ名からスタッフIDを取得するメソッド
    //セッションにスタッフIDを入れるため用
    public function get_staffid($user_name){
        $query = $this->db->get_where('StaffAccount', array('user_name' => $user_name));

        $row = $query->row();
        return $row->staff_id;
    }
}

?>
