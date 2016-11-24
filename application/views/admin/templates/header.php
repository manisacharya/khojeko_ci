<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Khojeko - Admin Panel</title>
    <meta name="description" content="">
    <meta name="author" content="Mukesh">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/css/bootstrap/bootstrap.css" />
    <!-- Calendar Styling  -->
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/css/plugins/calendar/calendar.css" />
    <!-- Fonts  -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300' rel='stylesheet' type='text/css'>
    <!-- Base Styling  -->
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/css/app/app.v1.css" />
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/css/app/admin.css" />
    <link href="<?php echo base_url('public/images/icons/icon.ico')?>" rel="shortcut icon" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body data-ng-app>
<aside class="left-panel">

    <div class="user text-center">
        <img src="<?php echo base_url('public'); ?>/images/avtar/user.png" class="img-circle" alt="...">
        <h4 class="user-name"><?php echo $user_info->admin_name?></h4>

        <div class="dropdown user-login" style="width: 150px;">
            <button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" aria-expanded="true" style="width: 150px;">
                Home <i class="fa fa-angle-down"></i>
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
            <li <?php if($title == "Index") { echo "class='active'";}?>><a href="<?php echo base_url('admin');?>"><span class="nav-label">Home</span></a></li>
            <li <?php if($title == "Post Ad") { echo "class='active'";}?>><a href="<?php echo base_url('admin');?>/post_ad">Post Ad</a></li>

            <li class="has-submenu<?php if(strpos($title, "Category") !== FALSE) { echo ' active';}?>"><a href="<?php echo base_url('admin');?>/#"> <span class="nav-label">Category Management</span></a>
                <ul class="list-unstyled">
                    <li <?php if($title == "Add Category") { echo "class='active'";}?>><a href="<?php echo base_url('admin');?>/category_add">Add Category</a></li>
                    <li <?php if($title == "Delete Category") { echo "class='active'";}?>><a href="<?php echo base_url('admin');?>/category_delete">Delete Category</a></li>
                    <li <?php if($title == "Edit Category") { echo "class='active'";}?>><a href="<?php echo base_url('admin');?>/category_edit">Edit Category</a></li>
                </ul>
            </li>
            <li class="has-submenu<?php if(strpos($title, "Site") !== FALSE) { echo ' active';}?>"><a href="<?php echo base_url('admin');?>/#"> <span class="nav-label">Banner Management</span></a>
                <ul class="list-unstyled">
                    <li <?php if($title == "Site Logo") { echo "class='active'";}?>><a href="<?php echo base_url('admin');?>/site_logo">Insert Site Logo</a></li>
                    <li><a href="<?php echo base_url('admin');?>/buttons">Top Menu Content Management</a></li>
                    <li><a href="<?php echo base_url('admin');?>/icons">Facebook Placeholder</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="<?php echo base_url('admin');?>/#"> <span class="nav-label">User Management</span></a>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url('admin');?>/personal_user">Personal User Verification</a></li>
                    <li><a href="<?php echo base_url('admin');?>/dealer_user">Dealer User Verification</a></li>

                </ul>
            </li>
            <li class="has-submenu"><a href="<?php echo base_url('admin');?>/#"><span class="nav-label">Security</span></a>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url('admin');?>/basic-tables">Bad Word Filter</a></li>
                    <li><a href="<?php echo base_url('admin');?>/data-tables">Spam Report (6)</a></li>
                    <li><a href="<?php echo base_url('admin');?>/data-tables">Send Alert Message</a></li>

                </ul>
            </li>
            <li class="has-submenu"><a href="<?php echo base_url('admin');?>/#"> <span class="nav-label">Email Inbox</span></a>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url('admin');?>/chart-variants">Support</a></li>
                    <li><a href="<?php echo base_url('admin');?>/gauges">Feed Backs</a></li>
                    <li><a href="<?php echo base_url('admin');?>/vector-maps">Enquiry</a></li>
                    <li><a href="<?php echo base_url('admin');?>/range-selector">Mass Mail</a></li>
                </ul>
            </li>
            <li class="has-submenu"><a href="<?php echo base_url('admin');?>/#"> <span class="nav-label">Admin Panel Setting</span></a>
                <ul class="list-unstyled">
                    <li><a href="<?php echo base_url('admin');?>/404">Admin User Promission</a></li>
                    <li><a href="<?php echo base_url('admin');?>/invoice">Email Template Setting</a></li>
                    <li><a href="<?php echo base_url('admin');?>/elfinder">Safety Tips Message(Detail Page)</a></li>
                    <li><a href="<?php echo base_url('admin');?>/google-maps">Disclaimer Message(Ad Post Page)</a></li>
                    <li><a href="<?php echo base_url('admin');?>/signup">Signup Page Text Message</a></li>
                </ul>
            </li>
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->
<section class="content">

    <div class="info underline">ADMINISTRATION CONTROL PANEL</div>
    <div class="info"><h3><?php echo $title?></h3></div>
