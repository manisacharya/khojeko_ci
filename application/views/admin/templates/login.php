<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="<?php echo base_url('public/css/app/admin_login.css');?>">

</head>

<body id="next">
<?php echo form_open('admin/login'); ?>
    <div class="login">
        <div class="login-screen">
            <div class="app-title">
                <!--<h1>Admin Login</h1>-->
            </div>

            <div class="login-form">
                <div class="control-group">
                    <input type="text" name="username" placeholder="username" id="login-name" value="<?=set_value('username');?>" class="login-field" size="50" />
                    <label class="login-field-icon fui-user" for="login-name"></label>
                    <?php echo form_error('username');?>
                </div>

                <div class="control-group">
                    <input type="password" name="password" placeholder="password" id="login-pass" class="login-field" />
                    <label class="login-field-icon fui-lock" for="login-pass"></label>
                    <?php echo form_error('password');?>
                </div>


                <button type="submit" class="btn btn-primary btn-large btn-block" href="#">login</button>
                <!--<a class="login-link" href="#">Lost your password?</a>-->
            </div>
        </div>
    </div>
<?=form_close();?>
</body>
</html>
