<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Attendance extends CI_Controller{

    public function in(){
        $this->load->library('form_validation');

        if($this->form_validation->run('attendance')){
            $this->load->model('Model_attendance');
            $this->Model_attendance->insert_attendance();
        }
    }
}
?>
