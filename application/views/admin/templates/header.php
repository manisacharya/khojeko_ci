<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Khojeko - Admin Panel</title>
    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap/bootstrap.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('public/css/plugins/calendar/calendar.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('public/css/app/app.v1.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('public/css/app/admin.css'); ?>" />
    <link href="<?php echo base_url('public/images/icons/icon.ico')?>" rel="shortcut icon" />
</head>
<body data-ng-app>
<aside class="left-panel">
    <div class="user text-center">
        <img src="<?php echo base_url('public'); ?>/images/avtar/user.png" class="img-circle" alt="...">
        <h4 class="user-name"><?php echo $user_info->admin_name?></h4>

        <div class="dropdown user-login" style="width: 150px;">
            <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" aria-expanded="true" style="width: 150px;">Home <span class="glyphicon glyphicon-chevron-down"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <?php if($user_info->is_primary == 1): ?>
                    <li role="presentation"><?php echo anchor("admin/sign_up", "Register User");?></li>
                <?php endif;?>
                <li role="presentation"><?php echo anchor("admin/change_password", "Change Password");?></li>
                <li role="presentation"><?php echo anchor('admin/logout', ' Log out', array('role' => 'menuitem'))?></li>
            </ul>
        </div>
    </div>

    <nav class="navigation">
        <ul class="list-unstyled">
            <li class="has-submenu<?php if(strpos($title, "Adv") !== FALSE) { echo ' active';}?>"><a href="<?php echo base_url('admin/#');?>"><span class="nav-label">Ads Management</span></a>
                <ul class="list-unstyled">
                    <li <?php if($title == "Adv Index") { echo "class='active'";}?>><a href="<?php echo base_url('admin/adv_index');?>">Advertisement Index</a></li>
                    <li <?php if($title == "Active Adv Personal") { echo "class='active'";}?>><a href="<?php echo base_url('admin/active_adv_personal');?>">Active Adv (Users:Personal)</a></li>
                    <li <?php if($title == "Active Adv Dealer") { echo "class='active'";}?>><a href="<?php echo base_url('admin/active_adv_dealer');?>">Active Adv (Users:Dealer)</a></li>
                    <li <?php if($title == "Inactive Adv Personal") { echo "class='active'";}?>><a href="<?php echo base_url('admin/inactive_adv_personal');?>">Inactive Adv (Users:Personal)</a></li>
                    <li <?php if($title == "Inactive Adv Dealer") { echo "class='active'";}?>><a href="<?php echo base_url('admin/inactive_adv_dealer');?>">Inactive Adv (Users:Dealer)</a></li>
                    <li <?php if($title == "Deleted Adv Personal") { echo "class='active'";}?>><a href="<?php echo base_url('admin/deleted_adv_personal');?>">Deleted Adv (Users:Personal)</a></li>
                    <li <?php if($title == "Deleted Adv Dealer") { echo "class='active'";}?>><a href="<?php echo base_url('admin/deleted_adv_dealer');?>">Deleted Adv (Users:Dealer)</a></li>
                </ul>
            </li>
            <li <?php if($title == "Post ad") { echo "class='active'";}?>><a href="<?php echo base_url('admin/post_ad');?>">Post Ad</a></li>
            <li class="has-submenu<?php if(strpos($title, "Category") !== FALSE) { echo ' active';}?>"><a href="<?php echo base_url('admin/#');?>"> <span class="nav-label">Category Management</span></a>
                <ul class="list-unstyled">
                    <li <?php if($title == "Add Category") { echo "class='active'";}?>><a href="<?php echo base_url('admin/category_add');?>">Add Category</a></li>
                    <li <?php if($title == "Delete Category") { echo "class='active'";}?>><a href="<?php echo base_url('admin/category_delete');?>">Delete Category</a></li>
                    <li <?php if($title == "Edit Category") { echo "class='active'";}?>><a href="<?php echo base_url('admin/category_edit');?>">Edit Category</a></li>
                </ul>
            </li>
            <li class="has-submenu<?php if(strpos($title, "Site") !== FALSE) { echo ' active';}?>"><a href="<?php echo base_url('admin/#');?>"> <span class="nav-label">Banner Management</span></a>
                <ul class="list-unstyled">
                    <li <?php if($title == "Site Logo") { echo "class='active'";}?>><a href="<?php echo base_url('admin/site_logo');?>">Insert Site Logo</a></li>
                    <li <?php if($title == "Site Top Banners") { echo "class='active'";}?>><a href="<?php echo base_url('admin/top_banners');?>">Top Menu Content Management</a></li>
                    <li><a href="<?php echo base_url('admin/icons');?>">Facebook Placeholder</a></li>
                    <li <?php if($title == "Partners Logo") { echo "class='active'";}?>><a href="<?php echo base_url('admin/partner_logo');?>">Partner Logo Management</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="<?php echo base_url('admin/#');?>"> <span class="nav-label">User Management</span></a>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url('admin/personal_user');?>">Personal User Verification</a></li>
                    <li><a href="<?php echo base_url('admin/dealer_user');?>">Dealer User Verification</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="<?php echo base_url('admin');?>/#"><span class="nav-label">Security</span></a>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url('admin/basic-tables');?>">Bad Word Filter</a></li>
                    <li><a href="<?php echo base_url('admin/data-tables');?>">Spam Report (6)</a></li>
                    <li><a href="<?php echo base_url('admin/data-tables');?>">Send Alert Message</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="<?php echo base_url('admin/#');?>"> <span class="nav-label">Email Inbox</span></a>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url('admin/chart-variants');?>">Support</a></li>
                    <li><a href="<?php echo base_url('admin/gauges');?>">Feed Backs</a></li>
                    <li><a href="<?php echo base_url('admin/vector-maps');?>">Enquiry</a></li>
                    <li><a href="<?php echo base_url('admin/range-selector');?>">Mass Mail</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="<?php echo base_url('admin/#');?>"> <span class="nav-label">Admin Panel Setting</span></a>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url('admin/404');?>">Admin User Permission</a></li>
                    <li><a href="<?php echo base_url('admin/invoice');?>">Email Template Setting</a></li>
                    <li><a href="<?php echo base_url('admin/elfinder');?>">Safety Tips Message(Detail Page)</a></li>
                    <li><a href="<?php echo base_url('admin/google-maps');?>">Disclaimer Message(Ad Post Page)</a></li>
                    <li><a href="<?php echo base_url('admin/signup');?>">Signup Page Text Message</a></li>
                </ul>
            </li>
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->
<section class="content">
    <div class="info underline">ADMINISTRATION CONTROL PANEL</div>
    <div class="info"><h3><?php echo $title?></h3></div>
