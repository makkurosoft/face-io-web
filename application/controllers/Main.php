<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller{

    public function index(){
        redirect('main/signin');
    }

    public function signin(){
        //セッション無ければsigninへ
        if(!$this->session->userdata('is_logged_in')){
            $data['title'] = 'Signin';

            $this->load->view('templates/header', $data);
            $this->load->view('signin');
            $this->load->view('templates/footer', $data);
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
            //URIの後ろにクラスの情報がない場合
            //クラス一覧の表示
            if($class_id === NULL){
                $data['user_name'] = $this->session->userdata('user_name');
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
                $data['class_id'] = $class_id;
                $this->load->model('Model_attendance');
                $attendence_statuses = $this->Model_attendance->get_attendance_statuses($class_id);
                $data['attendance_statuses'] = $attendence_statuses;
                $data['title'] = '出席状況一覧';
                $this->load->view('templates/header', $data);
                $this->load->view('attendance_statuses', $data);
                $this->load->view('templates/footer', $data);
            }
        }else{
            redirect ('main/signin');
        }
    }

    public function signin_validation(){
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
                redirect('main/signin');
            }
        }else{
            redirect('main/signin');
        }
    }
}
