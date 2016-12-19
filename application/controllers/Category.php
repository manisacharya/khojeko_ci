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

    public function get_sub_categories_and_items() {
        $this->output->set_content_type('application/json', 'utf-8');
        $slug = $this->input->post('slug');

        $this->data['json_objects'] = array (
            'category'                  => ($slug != NULL) ? $this->categories_model->get_category_name($slug): NULL,
            'sub_categories_list'       => ($slug != NULL) ? $this->categories_model->get_sub_categories($slug) : NULL,
            'sub_categories_items'      => ($slug != NULL) ? $this->categories_model->get_categories_items($slug) : NULL
        );
        $this->load->view("json/json_return", $this->data);
    }

}