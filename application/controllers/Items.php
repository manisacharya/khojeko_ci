<?php

/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 11/23/16
 * Time: 7:08 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Items extends CI_Controller {

    public $panel_url;

    function __Construct() {
        parent::__Construct();
        $this->load->model('database_models/items_model');
        $this->output->enable_profiler(TRUE);
        $this->panel_url = $this->session->flashdata('panel_url');

        if (! $this->session->has_userdata('logged_in'))
            show_error('Sorry, this page is not not available');
    }

    public function extend_date($id, $extend) {
        $this->items_model->extend_date($id, $extend);
        redirect($this->panel_url);
    }

    public function sold_unsold($id, $sales_status) {
        $this->items_model->sold_unsold($id, $sales_status);
        redirect($this->panel_url);
    }

    public function hide_unhide($id, $visibility) {
        $this->items_model->hide_unhide($id, $visibility);
        redirect($this->panel_url);
    }

    public function delete() {
        $this->items_model->delete();
        redirect($this->panel_url);
    }

    public function premium($id, $premium) {
        $this->items_model->premium($id, $premium);
        redirect($this->panel_url);
    }
}