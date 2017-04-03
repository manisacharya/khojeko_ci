        <div style="margin: 15px 0;">
            <?php echo $pwd_changed;?>
            <?php echo $login_msg;?>
        </div>
        <div class="control-form row">
            <h3>Account Login</h3>
            <?php echo form_open('login'); ?>
                <div class="text-center col-sm-12">
                    <input type="text" class="form-control " name="user_name" value="<?php echo set_value('user_name');?>" placeholder="Email or Mobile Number" required />
                    <?php echo form_error('user_name');?>
                    <input type="password" class="form-control" name="password" id="password" required placeholder="Password" />
                    <!--<a onclick="toggle_password('password');" id="showhide">Show</a>-->
                    <?php echo form_error('password');?>

                    <button class="btn btn-primary" type="submit">Sign In</button><br />
                    <a href="<?php echo base_url('lost_password'); ?>" class="lost">Lost Password?</a>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div><!--end of col-sm-9-->
</div><!--end of row-->
</div><!--end of container-->