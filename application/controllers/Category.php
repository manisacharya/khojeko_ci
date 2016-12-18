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
        //$this->output->enable_profiler(TRUE);
    }

    public function get_sub_categories_and_items($slug) {
        $this->output->set_content_type('application/json', 'utf-8');
        $this->data['json_objects'] = array (
            'sub_categories_list'       => $this->categories_model->get_sub_categories($slug),
            'sub_categories_items'      => $this->categories_model->get_categories_items($slug)
        );
        $this->load->view("json/json_return", $this->data);
    }

}