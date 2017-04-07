<?php

/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 1/26/17
 * Time: 11:52 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_pages extends CI_Controller
{
    public $data;
    function __Construct()
    {
        parent::__Construct();
        if (! $this->session->has_userdata('admin_logged_in'))
            redirect('admin/login');

        $this->load->library('form_validation');
        $this->load->model('database_models/user_model');
        $this->load->model('database_models/email_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);
        $this->data['categories'] = $this->categories_model->get_categories();
    }

    public function verification()
    {
        $this->data['title'] = "Email Verification";

        $this->form_validation->set_rules('v_content', 'Template Content', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->data['message'] = $this->session->flashdata('message');
            $this->data['templates'] = $this->email_model->get_email('verification');
            $this->load->view('admin/templates/header', $this->data);
            $this->load->view('admin/email/verification', $this->data);
            $this->load->view('admin/templates/footer');
        } else {
            if ($this->email_model->update_template() === TRUE) {
                $message = "<div class='alert alert-success'>Updated Successfully!</div>";
            }
            else {
                $message = "<div class='alert alert-danger'>Not Updated !</div>";
            }
            $this->session->set_flashdata('message', $message);
            redirect('admin/verification');
        }
    }

    public function support()
    {
        $this->data['title'] = "Email Support";

        $this->form_validation->set_rules('s_content', 'Template Content', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->data['message'] = $this->session->flashdata('message');
            $this->data['templates'] = $this->email_model->get_email('support');
            $this->load->view('admin/templates/header', $this->data);
            $this->load->view('admin/email/support', $this->data);
            $this->load->view('admin/templates/footer');
        } else {
            if ($this->email_model->update_template() === TRUE) {
                $message = "<div class='alert alert-success'>Updated Successfully!</div>";
            }
            else {
                $message = "<div class='alert alert-danger'>Not Updated !</div>";
            }
            $this->session->set_flashdata('message', $message);
            redirect('admin/support');
        }
    }

    public function feed()
    {
        $this->data['title'] = "Email Feedback";

        $this->form_validation->set_rules('f_content', 'Template Content', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->data['message'] = $this->session->flashdata('message');
            $this->data['templates'] = $this->email_model->get_email('feedback');
            $this->load->view('admin/templates/header', $this->data);
            $this->load->view('admin/email/feed', $this->data);
            $this->load->view('admin/templates/footer');
        } else {
            if ($this->email_model->update_template() === TRUE) {
                $message = "<div class='alert alert-success'>Updated Successfully!</div>";
            }
            else {
                $message = "<div class='alert alert-danger'>Not Updated !</div>";
            }
            $this->session->set_flashdata('message', $message);
            redirect('admin/feed');
        }
    }

    public function inquiry()
    {
        $this->data['title'] = "Email Inquiry";

        $this->form_validation->set_rules('i_content', 'Template Content', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->data['message'] = $this->session->flashdata('message');
            $this->data['templates'] = $this->email_model->get_email('inquiry');
            $this->load->view('admin/templates/header', $this->data);
            $this->load->view('admin/email/inquiry', $this->data);
            $this->load->view('admin/templates/footer');
        } else {
            if ($this->email_model->update_template() === TRUE) {
                $message = "<div class='alert alert-success'>Updated Successfully!</div>";
            }
            else {
                $message = "<div class='alert alert-danger'>Not Updated !</div>";
            }
            $this->session->set_flashdata('message', $message);
            redirect('admin/inquiry');
        }
    }

    public function mass_mail()
    {
        $this->data['title'] = "Email Mass Mail";

        $this->form_validation->set_rules('m_content', 'Template Content', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            $this->data['message'] = $this->session->flashdata('message');
            $this->data['templates'] = $this->email_model->get_email('mass_mail');
            $this->load->view('admin/templates/header', $this->data);
            $this->load->view('admin/email/mass_mail', $this->data);
            $this->load->view('admin/templates/footer');
        } else {
            if ($this->email_model->update_template() === TRUE) {
                $message = "<div class='alert alert-success'>Updated Successfully!</div>";
            }
            else {
                $message = "<div class='alert alert-danger'>Not Updated !</div>";
            }
            $this->session->set_flashdata('message', $message);
            redirect('admin/mass_mail');
        }
    }
}