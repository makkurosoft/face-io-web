<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller{

    public function index(){
        $this->signin();
    }

    public function signin(){
        $this->load->view('signin');
    }

    public function signout(){
        $this->session->sess_destroy();
        redirect('main/signin');
    }

    public function dashboard(){
        if($this->session->userdata('is_logged_in')){
            $data['user_name'] = $this->session->userdata('user_name');
            $this->load->view('dashboard', $data);
        }else{
            redirect ('main/signin');
        }
    }

    public function signin_validation(){
        $this->load->library('form_validation');
        $this->load->model('Model_teacher');

        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');

        if($this->form_validation->run('signin')){
            if($this->Model_teacher->signin($user_name, $password)){
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
