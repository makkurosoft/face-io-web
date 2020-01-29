<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller{

    public function index(){
        $this->signin();
    }

    public function signin(){
        //セッション無ければsigninへ
        if(!$this->session->userdata('is_logged_in')){
            $this->load->view('signin');
        //セッションがあればdashboardへ
        }else if($this->session->userdata('is_logged_in')){
            $this->dashboard();
        }
    }

    public function signout(){
        $this->session->sess_destroy();
        redirect('main/signin');
    }

    public function dashboard($class = NULL){
        //セッション判定
        if($this->session->userdata('is_logged_in')){
            //URIの後ろにクラスの情報がない場合
            //クラス一覧の表示
            if($class === NULL){
                $data['user_name'] = $this->session->userdata('user_name');
                $this->load->model('Model_class');
                $classes = $this->Model_class->get_classes($this->session->userdata('staff_id'));
                $data['classes'] = $classes;
                $this->load->view('dashboard', $data);
            //URIの後ろにクラスの情報されている場合
            //クラス指定で出席状況一覧表示
            }else{
                $data['class_name'] = $class;
                $this->load->view('attendancelist', $data);
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
                $this->load->view('signin');
            }
        }else{
                $this->load->view('signin');
        }
    }
}
