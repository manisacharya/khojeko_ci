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
$route['lost_password'] = "user_session/lost_password";
$route['lost_password/(:any)'] = "user_session/lost_password_change/$1";
$route['new_password'] = "user_session/new_password";

// khojeko CONTROLLER ROUTE
$route['redirecter'] = "khojeko/redirecter";
$route['heirarchy'] = "khojeko/heirarchy";
$route['modify'] = "khojeko/modify";

// USER PANEL CONTROLLER ROUTE
$route['upanel/(:any)'] = "pages/personal_panel/$1";
$route['upanel/(:any)/(:any)'] = "pages/personal_panel/$1/$2";
$route['change_password'] = "pages/change_password";

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
$route['add_to_fav/(:num)'] = "details/add_to_fav/$1";
$route['add_to_spam/(:num)/(:num)'] = "details/add_to_spam/$1/$2";

// SEARCH CONTROLLER
$route['results'] = "search/results";

// FILTER CONTROLLER
$route['filter'] = "filter";

// UPLOAD CONTROLLER
$route['upload_view'] = "upload/upload_view";
$route['upload_file'] = "upload/upload_file";

// ADMIN SESSION CONTROLLER
$route['admin'] = 'admin/admin_pages/page';
$route['admin/site_logo'] = 'admin/upload/site_logo/';
$route['admin/logo_upload'] = 'admin/upload/logo_upload/';
$route['admin/adv_index'] = 'admin/admin_pages/page';
//admin active advertisements
$route['admin/active_adv_personal'] = 'admin/admin_pages/page/active_adv_personal';
$route['admin/active_adv_personal/(:num)'] = 'admin/admin_pages/page/active_adv_personal/$1';
$route['admin/active_adv_dealer'] = 'admin/admin_pages/page/active_adv_dealer';
$route['admin/active_adv_dealer/(:num)'] = 'admin/admin_pages/page/active_adv_dealer/$1';
//admin inactive advertisements
$route['admin/inactive_adv_personal'] = 'admin/admin_pages/page/inactive_adv_personal';
$route['admin/inactive_adv_personal/(:num)'] = 'admin/admin_pages/page/inactive_adv_personal/$1';
$route['admin/inactive_adv_dealer'] = 'admin/admin_pages/page/inactive_adv_dealer';
$route['admin/inactive_adv_dealer/(:num)'] = 'admin/admin_pages/page/inactive_adv_dealer/$1';
//admin deleted advertisements
$route['admin/deleted_adv_personal'] = 'admin/admin_pages/page/deleted_adv_personal';
$route['admin/deleted_adv_personal/(:num)'] = 'admin/admin_pages/page/deleted_adv_personal/$1';
$route['admin/deleted_adv_dealer'] = 'admin/admin_pages/page/deleted_adv_dealer';
$route['admin/deleted_adv_dealer/(:num)'] = 'admin/admin_pages/page/deleted_adv_dealer/$1';

$route['admin/category_add'] = 'admin/admin_pages/add_category';
$route['admin/category_delete'] = 'admin/admin_pages/delete_category';
$route['admin/category_edit'] = 'admin/admin_pages/edit_category';
$route['admin/login'] = 'admin/users/login';
$route['admin/sign_up'] = 'admin/users/sign_up';
$route['admin/logout'] = 'admin/users/logout';
$route['admin/change_password'] = 'admin/users/change_password';
$route['admin/post_ad'] = 'admin/item_post/post_form';

$route['admin/get_districts_admin'] = 'admin/item_post/get_district_admin';
$route['admin/available_email_admin'] = 'admin/item_post/available_email_admin';
$route['admin/available_username_admin'] = "admin/item_post/available_username_admin";
$route['admin/available_mobile_admin'] = "admin/item_post/available_mobile_admin";
//$route['admin/(:any)/(:num)'] = 'admin/admin_pages/page/$1/$2';
$route['admin/index/(:any)/(:num)'] = 'admin/admin_pages/page/index/$1/$2';
$route['admin/extend_date/(:num)/(:num)'] = 'admin/admin_pages/extend_date/$1/$2';

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