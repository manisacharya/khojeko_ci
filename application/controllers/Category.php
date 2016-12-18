<?php

/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 12/17/16
 * Time: 9:11 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model('database_models/categories_model');
    }

    public function get_sub_categories($slug) {
        $this->output->set_content_type('application/json', 'utf-8');
        $this->data['json_objects'] = array (
            'sub_categories' => $this->categories_model->get_sub_categories($slug)
        );
        $this->load->view("json/json_return", $this->data);
    }

    public function get_categories_items() {

    }

}