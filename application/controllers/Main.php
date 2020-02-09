<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller{

    public function index(){
        redirect('main/signin');
    }

    public function signin(){
        //セッション無ければsigninへ
        if(!$this->session->userdata('is_logged_in')){
            $this->load->library('form_validation');
            $this->load->model('Model_teacher');

            $user_name = $this->input->post('user_name');
            $password = $this->input->post('password');

            //フォームの入力値チェック
            if($this->form_validation->run('signin')){
                //ユーザ名とパスワードの照合
                if($this->Model_teacher->signin($user_name, $password)){
                    //セッションを登録しdashboardへ
                    $data = array(
                        'staff_id' => $this->Model_teacher->get_staffid($user_name),
                        'user_name' => $user_name,
                        'is_logged_in' => 1
                    );
                    $this->session->set_userdata($data);
                    redirect('main/dashboard');
                }else{
                    $data['title'] = 'Signin';
                    $data['errorMessage'] = 'ユーザ名かパスワードに誤りがあります。';
                    $this->load->view('templates/header', $data);
                    $this->load->view('signin', $data);
                    $this->load->view('templates/footer', $data);
                }
            }else{
                $data['title'] = 'Signin';
                $data['errorMessage'] = '';
                $this->load->view('templates/header', $data);
                $this->load->view('signin');
                $this->load->view('templates/footer', $data);
            }
        //セッションがあればdashboardへ
        }else if($this->session->userdata('is_logged_in')){
            redirect('main/dashboard');
        }
    }

    public function signout(){
        $this->session->sess_destroy();
        redirect('main/signin');
    }

    public function dashboard($class_id = NULL){
        //セッション判定
        if($this->session->userdata('is_logged_in')){
            $data['user_name'] = $this->session->userdata('user_name');
            //URIの後ろにクラスの情報がない場合
            //クラス一覧の表示
            if($class_id === NULL){
                $this->load->model('Model_class');
                $classes = $this->Model_class->get_classes($this->session->userdata('staff_id'));
                $data['classes'] = $classes;

                $data['title'] = 'Dashboard';
                $this->load->view('templates/header', $data);
                $this->load->view('dashboard', $data);
                $this->load->view('templates/footer', $data);
            //URIの後ろにクラスidが指定されている場合
            //クラスの出席状況一覧表示
            }else{
                //クラス名をDBから取得する
                $data['class_id'] = $class_id;
                $this->load->model('Model_class');
                $class_name = $this->Model_class->get_classname($class_id);
                $data['class_name'] = $class_name;
                if(!$class_name){
                    $data['title'] = 'エラー';
                    $this->load->view('templates/header', $data);
                    $this->load->view('error', $data);
                    $this->load->view('templates/footer', $data);
                }else{
                    //出席一覧をDBから取得する
                    $this->load->model('Model_attendance');
                    $attendence_statuses = $this->Model_attendance->get_attendance_statuses($class_id);
                    $data['attendance_statuses'] = $attendence_statuses;
                    $data['title'] = '出席状況一覧';
                    $this->load->view('templates/header', $data);
                    $this->load->view('attendance_statuses', $data);
                    $this->load->view('templates/footer', $data);
                }
            }
        }else{
            redirect ('main/signin');
        }
    }

	public function history($class_id = NULL){
        if($this->session->userdata('is_logged_in')){
          $data['user_name'] = $this->session->userdata('user_name');
          $this->load->model('Model_class');
          $this->load->model('Model_attendance');

          // class_idの指定がない場合
          if ($class_id === NULL){
            redirect ('main/dashboard');
          }else{
            $data['class_id'] = $class_id;
          }

          //クラス名をDBから取得する
          $class_name = $this->Model_class->get_classname($class_id);
          $data['class_name'] = $class_name;

          // 不正なクラスIDだった場合エラー画面に遷移
          if(!$class_name){
            $data['title'] = 'エラー';
            $this->load->view('templates/header', $data);
            $this->load->view('error', $data);
            $this->load->view('templates/footer', $data);
            return;
          }

          // クラスの所属生徒一覧を取得
          $students = $this->Model_class->get_student_list($class_id);
          $data['students'] = $students;

          // <th>用の日付仮想表を取得する
          $dates = $this->Model_attendance->get_dates();
          $data['dates'] = $dates;

          // 所属生徒の出席履歴を取得する
          $at_hists = array();
          foreach($students as $student){
            array_push($at_hists, $this->Model_attendance->get_one_data($student['label_id']));
          }
          $data['at_hists'] = $at_hists;

          $data['title'] = '出席履歴';
          $this->load->view('templates/header', $data);
          $this->load->view('attendance_histories', $data);
          $this->load->view('templates/footer', $data);

        }else{
            redirect ('main/signin');
        }
	}
}
