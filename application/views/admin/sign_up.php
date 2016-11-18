
<div class="col-sm-12">
<?php echo form_open('admin/sign_up', array('class'=>'form')); ?>
    <?php echo $message;?>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?=set_value('username');?>" class="form-control" size="50" />
        <?=form_error('username');?>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" size="50" />
        <?=form_error('password');?>
    </div>
    <div class="form-group">
        <label for="pass_confirm">Password Confirm</label>
        <input type="password" name="pass_confirm" id="pass_confirm" class="form-control" size="50" />
        <?=form_error('pass_confirm');?>
    </div>
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email" value="<?=set_value('email');?>" class="form-control" size="50" />
        <?=form_error('email');?>
    </div>
    <div class="form-group">
        <label>User Type</label><br />
        <input type="radio" name="user_type" id="dealer_type" value="dealer" />
        <label for="dealer_type">Dealer</label>
        <input type="radio" name="user_type" id="personal_type" value="personal" />
        <label for="personal_type">Personal</label>
        <input type="radio" name="user_type" id="admin_type" value="admin" />
        <label for="admin_type">Admin</label>
        <?=form_error('email');?>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Create Account</button>
    </div>

    <?php
    echo form_open('details_validation');
    echo validation_errors();

    echo "<p>*User name:";
    echo form_input('user_name', $this->input->post('user_name'));
    echo "</p>";

    echo "<p>*User email:";
    echo form_input('user_email', $this->input->post('user_email'));
    echo "</p>";

    echo "<p>*New Password:";
    echo form_password('password');
    echo "</p>";

    echo "<p>*Retype Password:";
    echo form_password('re-password');
    echo "</p>";

    echo "<p>Account Type:";
    $data_radio1 = array(
        'name' => 'acc_type',
        'value' => 'personal',
        'id' => 'personal'
    );
    echo form_radio($data_radio1).form_label('Personal Ac', 'personal');
    $data_radio2 = array(
        'name' => 'acc_type',
        'value' => 'dealer',
        'id' => 'dealer',
        'checked' => TRUE
    );
    echo form_radio($data_radio2).form_label('Company Ac(Distributed/Dealer/Retail)', 'dealer');
    echo "</p>";
    ?>

    <div id="website">
        <?php
        echo "<p>Website Address: http://www.khojeko.com/";
        echo form_input('website', $this->input->post('website'));
        echo "</p>";
        ?>
    </div>

    <?php

    echo "<p>Captcha:";
    echo "<div class='g-recaptcha' data-sitekey='6LdaZCITAAAAAJ99HnRAhCbkJ7us0MUGmXkDW94p'></div>";
    echo form_input('captcha', '', 'placeholder="Type the above text here"');
    echo "</p>";

    echo "<p>";
    echo form_checkbox('termsandcondition', 'accept').form_label('I Agree with the ')."<a href='#'>Terms & Conditions</a>";
    echo "</p>";

    echo "<p>";
    echo form_submit('signup_next', 'Next');
    echo "</p>";

    echo form_close();
    ?>

    <?=form_close();?>
</div><!--col-sm-12-->
</section>
