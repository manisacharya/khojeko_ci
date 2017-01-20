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
        $this->load->model('database_models/retailer_partners_model');
        $this->load->model('database_models/categories_model');
        $this->load->model('khojeko_db_model');
        $this->load->model('database_models/dealer_model');
        $this->load->model('database_models/items_model');
        $this->load->model('database_models/user_model');
        $this->load->model('database_models/item_img_model');
        $this->session->set_flashdata('previous_url', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        //$this->output->enable_profiler(TRUE);
    }

    public function index() {

        $data['section_position'] = $this->categories_model->get_position();

        $data['items'] = $this->khojeko_db_model->join_tables();

        $data['filtered_items'] = $this->khojeko_db_model->join_filtered_tables($data['section_position']);

        $this->get_common_contents($data);

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/home', $data);
        $this->load->view('pages/templates/footer', $data);
    }

    public function personal_page($encoded_username, $encoded_category = 'all') {
        $username = urldecode($encoded_username);
        $category = urldecode($encoded_category);

        $this->get_common_contents($data);

        $data['personal_info'] = $this->user_model->get_user_info('personal', $username);
        $data['personal_items'] = $this->items_model->get_personal_items($username, TRUE); // visibility check

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/user_page', $data);
        $this->load->view('pages/templates/footer');
    }

    public function dealer_page($encoded_username, $encoded_category = 'all') {
        $username = urldecode($encoded_username);
        $category = urldecode($encoded_category);

        $this->get_common_contents($data);

        $data['dealer_info'] = $this->user_model->get_user_info('dealer', $username);
        $data['all_dealer_items'] = $this->items_model->get_dealer_items($username, TRUE); // visibility check
        $this->load->model('database_models/store_images_model');
        $data['store_images'] = $this->store_images_model->get_store_images($data['dealer_info']->d_id);

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/dealer_page', $data);
        $this->load->view('pages/templates/footer');
    }

    public function personal_panel($encoded_username, $encoded_category = 'all') {
        $username = urldecode($encoded_username);
        $category = urldecode($encoded_category);

        if (!$this->session->has_userdata('logged_in') || $this->session->userdata['logged_in']['type'] != 'personal')
            show_error('Sorry, page broken.');

        $this->session->set_flashdata('panel_url', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        $data['message'] = $this->session->flashdata('message');

        $this->get_common_contents($data);

        $data['user_item_counts'] = $this->items_model->count_user_page_items();

        $data['all_personal_items'] = $this->items_model->get_personal_items($username);
        $data['personal_info'] = $this->user_model->get_user_info('personal', $username);

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/user_panel', $data);
        $this->load->view('pages/templates/footer');
    }

    public function dealer_panel($encoded_username, $encoded_category = 'all') {
        $username = urldecode($encoded_username);
        $category = urldecode($encoded_category);

        if (!$this->session->has_userdata('logged_in') || $this->session->userdata['logged_in']['type'] != 'dealer')
            show_error('Sorry, page broken.');

        $this->session->set_flashdata('panel_url', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        $data['message'] = $this->session->flashdata('message');

        $this->get_common_contents($data);
        $data['user_item_counts'] = $this->items_model->count_user_page_items();

        $data['all_dealer_items'] = $this->items_model->get_dealer_items($username);
        $data['dealer_info'] = $this->user_model->get_user_info('dealer', $username);

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/dealer_panel', $data);
        $this->load->view('pages/templates/footer');
    }

    public function post_form()
    {
        $this->load->library('form_validation');

        //$data['title'] = 'Post ad';
        if (!$this->session->has_userdata('logged_in')) {
            $this->session->set_flashdata('previous_url', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            redirect('login');
        }

        $session_data = $this->session->userdata('logged_in');

        $this->get_common_contents($data);

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $detail = $this->user_model->get_user_info($session_data['type'], $session_data['username']);

//        echo "<pre>";
//        print_r($detail);
//        echo "</pre>";
//        die();

        $this->form_validation->set_rules('postc_slug', 'Category', 'required|trim');

        $this->load->view('pages/templates/header', $data);

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = "";

            $data['user_type'] = $detail->type;

            //$this->session->set_flashdata('data', $data);

            //redirect('adpost');
            $this->load->view('pages/freepost', $data);
            $this->load->view('pages/templates/footer', $data);

        } else {
            if (strtoupper($detail->type) == "PERSONAL") {

                $this->form_valid_check();
                $this->form_validation->set_rules('ad_type_personal', 'Ad type', 'required');

                if ($this->form_validation->run()) {
                    $this->items_model->add_item($detail);

                    $this->personal_upload($detail);

                    $data['message'] = "Successfully Added !";
                } else {
                    $data['message'] = "Error occur while posting item!";
                }
                

                $data['user_type'] = $detail->type;
                $this->load->view('pages/freepost', $data);
                $this->load->view('pages/templates/footer', $data);

            }else{
                $this->form_valid_check();

                $this->form_validation->set_rules('ad_type_dealer', 'Ad type', 'required');
                $this->form_validation->set_rules('quantity_dealer', 'Quantity', 'required|trim');

                if ($this->form_validation->run()) {
                    $this->items_model->add_item($detail);

                    $this->personal_upload($detail);

                    $data['message'] = "Successfully Added !";
                } else {
                    $data['message'] = "Error occur while posting item!";
                }
                $data['user_type'] = $detail->type;
                $this->load->view('pages/freepost', $data);
                $this->load->view('pages/templates/footer', $data);
            }
        }
    }

    public function form_valid_check(){
        $this->form_validation->set_rules('ad_title', 'Ad Title', 'required|trim|max_length[100]');

        if($this->input->post('bought_from') == "Abroad")
            $this->form_validation->set_rules('abroad_country', 'Abroad Country', 'required|trim|max_length[30]');

        $this->form_validation->set_rules('offer', 'Offer Price', 'required|trim|numeric');
        $this->form_validation->set_rules('used_for_text', 'Used For Text', 'required|trim|numeric');
        $this->form_validation->set_rules('market_price', 'Market Price', 'trim|numeric');
        $this->form_validation->set_rules('document_no', 'Documnet No', 'trim|alpha_dash');
        $this->form_validation->set_rules('ad_details', 'Ad Details', 'required|trim|max_length[300]');
        $this->form_validation->set_rules('site_url', 'Site URL', 'trim|valid_url');

        if($this->input->post('home_delivery') == 1)
            $this->form_validation->set_rules('delivery_charge', 'Delivery Charge', 'required|trim|numeric');

        $this->form_validation->set_rules('warranty', 'Warranty', 'trim|alpha_numeric_spaces');

        if($this->input->post('owner_proof[]') == "Not")
            $this->form_validation->set_rules('reason', 'No owner proof reason', 'required|trim|alpha_numeric_spaces');

        $this->form_validation->set_rules('video1_url', 'Video 1 URL', 'trim|valid_url');
        $this->form_validation->set_rules('video2_url', 'Video 2 URL', 'trim|valid_url');
    }

    public function personal_upload($detail) {
        $this->load->library('upload');
        $config = array(
            'upload_path'   => './public/images/item_images',
            'allowed_types' => 'jpg|png',
            'max_size'      => 10000,
            'max_width'     => 10000,
            'max_height'    => 10000,
            'overwrite'     => FALSE
        );

        $filename_arr = array();
        $count=1;
        $a = 1;

        $name = $detail->khojeko_username;
        $ad = $this->items_model->get_ad_name();
        $id = $this->items_model->get_item_id();

        foreach ($_FILES as $key => $value) {
            //if($count>2) {
            $config['file_name'] = $name . "_" . $ad . $a++;
            $this->upload->initialize($config);

            if (!empty($value['tmp_name']) && $value['size'] > 0) {
                if ($this->upload->do_upload($key)) {
                    // Code After Files Upload Success GOES HERE
                    $data_name = $this->upload->data();
                    if($count == 1){
                        $filename_arr[] = array(
                            'image' => $data_name['file_name'],
                            'item_id' => $id,//$this->item_model->get_item_id(),
                            'primary' => 1
                        );
                    }else {
                        $filename_arr[] = array(
                            'image' => $data_name['file_name'],
                            'item_id' => $id,//$this->item_model->get_item_id(),
                            'primary' => 0
                        );
                    }
                } else {
                    $error = array('error' => $this->upload->display_errors());;
                    $this->load->view('admin/post_ad', $error);
                }
            }
            $count++;
        }
        $this->item_img_model->add_img($filename_arr);
    }

    public function get_common_contents(&$data) {
        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->dealer_model->get_all_dealers();

        $data["total_items"] = $this->items_model->count_items();
        $data["used_items"] = $this->items_model->count_status_items('used');
        $data["new_items"] = $this->items_model->count_status_items('new');
        $data['dealer_items'] = $this->items_model->count_user_items('dealer');
        $data['user_items'] = $this->items_model->count_user_items('personal');

        $data['retailer_partners'] = $this->retailer_partners_model->get_retailer_partners();

        $data['popular_district'] = $this->khojeko_db_model->popular_district();
        $data['popular_category'] = $this->khojeko_db_model->popular_category();
        $data['popular_dealer'] = $this->khojeko_db_model->popular_dealer();


        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }
    }

    public function change_password(){
        $this->get_common_contents($data);
        if (!$this->session->has_userdata('logged_in'))
            show_error('Sorry, page broken.');

        $this->load->library('form_validation');
        $this->form_validation->set_rules(
            'o_password', 'Old Password',
            array(
                array(
                    'message_password_validate',
                    array($this->user_model, 'account_password_validate')
                )
            ),
            array(
                'message_password_validate'=> '{field} not matched.'
            )
        );
        $this->form_validation->set_rules('n_password', 'New Password', 'required|min_length[6]|differs[o_password]');
        $this->form_validation->set_rules('c_password', 'Confirm Password', 'required|trim|matches[n_password]');

        if($this->form_validation->run()){
            $this->user_model->change_password_user();
            redirect('change_password');
        } else {
            $data['change_pwd'] = $this->session->flashdata('change_password');

            $this->load->view("pages/templates/header", $data);
            $this->load->view("pages/change_password", $data);
            $this->load->view("pages/templates/footer", $data);
        }
    }

}
