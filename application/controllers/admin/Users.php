<?php

/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 9/21/16
 * Time: 9:58 PM
 */
class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_models/user_model');
        $this->load->helper('form');
    }

    public function sign_up() {
        if (! $this->session->has_userdata('admin_logged_in'))
            redirect('admin/login');

        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);
        if ($data['user_info']->is_primary != 1) {
            show_404();
        }
        $data['title'] = 'New Admin';
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->load->view('admin/templates/header', $data);
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = $this->session->flashdata('message');
            $this->load->view('admin/sign_up', $data);
        }
        else {
            if ($this->user_model->register_user()) {
                $message = "<div class='alert alert-success'>Registered Successfully!</div>";
            }
            else {
                $message = "<div class='alert alert-danger'>Not Registered !</div>";
            }
            $this->session->set_flashdata('message', $message);
            redirect('admin/sign_up');
        }
        $this->load->view('admin/templates/footer', $data);
    }

    public function change_password() {
        if (! $this->session->has_userdata('admin_logged_in'))
            redirect('admin/login');

        $this->load->library('form_validation');
        $data['title'] = "Change Password";
        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules(
            'current_password', 'Current Password',
            array(
                array(
                    'message_password_validate',
                    array($this->user_model, 'password_validate')
                )
            ),
            array(
                'message_password_validate'=> '{field} not matched.'
            )
        );
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|differs[current_password]',
            array(
                'required'      => 'You must provide a {field}.',
                'min_length'    => '{field} must contain minimum {param} characters.',
                'differ'        => 'Please enter different password'
            )
        );
        $this->form_validation->set_rules ('pass_confirm', 'Password Confirmation', 'required|matches[password]',
            array(
                'matches'   => 'Password not matched'
            )
        );

        $this->load->view('admin/templates/header', $data);
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = $this->session->flashdata('message');
            $this->load->view('admin/change_password', $data);
        }
        else {
            if ($this->user_model->change_password()) {
                $message = "<div class='alert alert-success'>Password Changed Successfully !</div>";
            }
            else {
                $message = "<div class='alert alert-danger'>Not Changed</div>";
            }

            $this->session->set_flashdata('message', $message);
            redirect('admin/change_password');
        }
        $this->load->view('admin/templates/footer');
    }

    public function login() {
        if($this->session->has_userdata('admin_logged_in'))
            redirect('admin');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules(
            'password', 'Password',
            array('required',
                array(
                    'login_validate',                           // for error message
                    array($this->user_model, 'user_validate')  // calling user_validate method from user_model
                )
            ),
            array(
                'required'      => '{field} field empty',
                'login_validate'=> 'Username or Password not matched.'
            )
        );

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/templates/login');
        }
        else {
            redirect('admin');
        }
    }   

    public function logout () {
        if (! $this->session->has_userdata('admin_logged_in'))
            redirect('admin/login');

        $this->session->unset_userdata('admin_logged_in');
        redirect('admin');
    }
}