<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/29/16
 * Time: 9:44 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    function __Construct() {
        parent::__Construct ();
        //$this->load->database(); // load database
        $this->load->model('database_models/categories_model');
        $this->load->model('index_database_model'); // load model
        $this->load->model('khojeko_db_model');
        $this->load->model('general_database_model');
        $this->output->enable_profiler(TRUE);
    }

    public function index() {
        //for top ad type listing
        $data['adList'] = $this->index_database_model->joinTable('items', 'user', 'user_id');

        //for the For Sales: Latest Ad --> images
        $data['dat'] = $this->index_database_model->joinTableOrder('item_img', 'items', 'item_id', 'published_date');

        //for the For Sales: Latest Ad --> details
        $data['oth'] = $this->index_database_model->joinTable('items', 'item_spec', 'item_id');

        //for the For Sales: Latest Ad --> Ad By name
        $data['othUs'] = $this->index_database_model->joinTable('items', 'user', 'user_id');

        //for populating ad by greatest view
        $data['grtView'] = $this->index_database_model->joinTableOrder('item_img', 'items', 'item_id', 'views');

        //for realstate
        $data['house'] = $this->index_database_model->selHouLand();

        $data['service'] = $this->index_database_model->selectWhat('Services');

        $data['job'] = $this->index_database_model->selectWhat('Jobs');

        // for dealer list
        //$data['dealer_list'] = $this->general_database_model->getAll('dealer', 'name', 'ASC');
        $dealer_list_joins = array(
            array (
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            )
        );
        /*item/Category JOIN ARRAY*/
        $item_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'category',
                'condition' => 'items.c_id = category.c_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_img',
                'condition' => 'items.item_id = item_img.item_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_spec',
                'condition' => 'items.item_id = item_spec.item_id',
                'jointype' => 'INNER'
            )
        );

        $personal_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'personal',
                'condition' => 'user.user_key = personal.p_id',
                'jointype' => 'INNER'
            )
        );
        
        //$data["category"] = $this->general_database_model->getAll('category', 'c_id', 'ASC');
        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->khojeko_db_model->joinThings('user', 'khojeko_username, name', $dealer_list_joins, 'type="dealer"');

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "1=1");
        $data["used_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='used'");
        $data["new_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='new'");
        $data['dealer_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $item_joins, 'type="dealer"');
        $data['user_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $personal_joins, 'type="personal"');

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/home', $data);
        $this->load->view('pages/templates/footer');
    }

    public function personal_page($personal) {
        // for dealer list
        //$data['dealer_list'] = $this->general_database_model->getAll('dealer', 'name', 'ASC');
        $dealer_list_joins = array(
            array (
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            )
        );
        /*item/Category JOIN ARRAY*/
        $item_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'category',
                'condition' => 'items.c_id = category.c_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_img',
                'condition' => 'items.item_id = item_img.item_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_spec',
                'condition' => 'items.item_id = item_spec.item_id',
                'jointype' => 'INNER'
            )
        );

        $personal_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'personal',
                'condition' => 'user.user_key = personal.p_id',
                'jointype' => 'INNER'
            )
        );

        //$data["category"] = $this->general_database_model->getAll('category', 'c_id', 'ASC');
        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->khojeko_db_model->joinThings('user', 'khojeko_username, name', $dealer_list_joins, 'type="dealer"');

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "1=1");
        $data["used_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='used'");
        $data["new_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='new'");
        $data['dealer_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $item_joins, 'type="dealer"');
        $data['user_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $personal_joins, 'type="personal"');

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }

        $this->load->model('database_models/user_model');
        $data['personal_info'] = $this->user_model->get_user_info('personal', $personal);
        $this->load->model('database_models/items_model');
        $data['personal_items'] = $this->items_model->get_personal_items($personal);

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/user_page', $data);
        $this->load->view('pages/templates/footer');
    }

    public function dealer_panel($dealer) {
        // for dealer list
        //$data['dealer_list'] = $this->general_database_model->getAll('dealer', 'name', 'ASC');
        $dealer_list_joins = array(
            array (
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            )
        );
        /*item/Category JOIN ARRAY*/
        $item_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'category',
                'condition' => 'items.c_id = category.c_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_img',
                'condition' => 'items.item_id = item_img.item_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_spec',
                'condition' => 'items.item_id = item_spec.item_id',
                'jointype' => 'INNER'
            )
        );

        $personal_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'personal',
                'condition' => 'user.user_key = personal.p_id',
                'jointype' => 'INNER'
            )
        );

        //$data["category"] = $this->general_database_model->getAll('category', 'c_id', 'ASC');
        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->khojeko_db_model->joinThings('user', 'khojeko_username, name', $dealer_list_joins, 'type="dealer"');

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "1=1");
        $data["used_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='used'");
        $data["new_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='new'");
        $data['dealer_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $item_joins, 'type="dealer"');
        $data['user_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $personal_joins, 'type="personal"');

        $this->load->model('database_models/user_model');
        $data['dealer_info'] = $this->user_model->get_user_info('dealer', $dealer);
        $this->load->model('database_models/items_model');
        $data['all_dealer_items'] = $this->items_model->get_dealer_items($dealer);

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/dealer_panel', $data);
        $this->load->view('pages/templates/footer');
    }
}