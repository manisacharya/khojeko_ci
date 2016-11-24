<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'pages';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// INDEX CONTROLLER ROUTE
$route['home'] = "homepage/home";

//item post
$route['adpost'] = "pages/post_form";

// PERSONAL SESSION CONTROLLER
$route['login'] = "user_session/login";
$route['logged_in'] = "user_session/logged_in";
$route['logout'] = "user_session/logout";
$route['login_validation'] = "user_session/login_validation";

// khojeko CONTROLLER ROUTE
$route['redirecter'] = "khojeko/redirecter";
$route['heirarchy'] = "khojeko/heirarchy";
$route['modify'] = "khojeko/modify";

// USER PANEL CONTROLLER ROUTE
$route['upanel/(:any)'] = "pages/personal_panel/$1";
$route['upanel/(:any)/(:any)'] = "pages/personal_panel/$1/$2";

// DEALER CONTROLLER ROUTE
$route['dealer/(:any)'] = "pages/dealer_page/$1";
$route['dealer/(:any)/(:any)'] = "pages/dealer_page/$1/$2";

// DETAIL CONTROLLER ROUTE
// signup
$route['signup'] = "Signup/signup";
$route['signup_done'] = "Signup/signup_done";
$route['details_validation'] = "Signup/details_validation";
$route['register_user/(:any)'] = "Signup/register_user/$1";
$route['get_districts'] = "Signup/get_districts";
//check unique username
$route['available_username'] = "Signup/available_username";
//check unique user email
$route['available_email'] = "Signup/available_email";
//check unique mobile number in personal
$route['available_mobile_P'] = "Signup/available_mobile_P";
//check unique mobile number in dealer
$route['available_mobile_d'] = "Signup/available_mobile_d";

// details
$route['details'] = "details/details";
$route['details/(:any)'] = "details/details/$1";

//ask me
$route['ask-me/(:any)'] = "details/add_question_ask_me/$1";
$route['ask-me/(:any)'] = "details/ask_me_validation/$1";

// SEARCH CONTROLLER
$route['results'] = "search/results";

// UPLOAD CONTROLLER
$route['upload_view'] = "upload/upload_view";
$route['upload_file'] = "upload/upload_file";

// ADMIN SESSION CONTROLLER
$route['admin'] = 'admin/admin_pages/page';
$route['admin/logo_upload'] = 'admin/upload/logo_upload/';
$route['admin/category_add'] = 'admin/admin_pages/add_category';
$route['admin/category_delete'] = 'admin/admin_pages/delete_category';
$route['admin/category_edit'] = 'admin/admin_pages/edit_category';
$route['admin/login'] = 'admin/users/login';
$route['admin/sign_up'] = 'admin/users/sign_up';
$route['admin/logout'] = 'admin/users/logout';
$route['admin/change_password'] = 'admin/users/change_password';
$route['admin/post_ad'] = 'admin/item_post/post_form';
$route['get_district'] = 'admin/item_post/get_district';
$route['available_email_admin'] = 'admin/item_post/available_email';
$route['admin/(:any)'] = 'admin/admin_pages/page/$1';

// USER PAGE
$route['user/(:any)'] = 'pages/personal_page/$1';

// DEALER PANEL
$route['dpanel/(:any)'] = 'pages/dealer_panel/$1';
$route['dpanel/(:any)/(:any)'] = 'pages/dealer_panel/$1/$2';

// ITEMS CONTROL
$route['delete'] = 'items/delete';
$route['edit'] = 'items/edit';
$route['sold_unsold/(:num)/(:num)'] = 'items/sold_unsold/$1/$2';
$route['hide_unhide/(:num)/(:num)'] = 'items/hide_unhide/$1/$2';
$route['extend_date/(:num)/(:num)'] = 'items/extend_date/$1/$2';
$route['premium/(:num)/(:num)'] = 'items/premium/$1/$2';