
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
        <label for="admin_name">Full Name</label>
        <input type="text" name="admin_name" id="admin_name" value="<?=set_value('admin_name');?>" class="form-control" size="50" />
        <?=form_error('admin_name');?>
    </div>
    <div class="form-group">
        <label for="mob">Mobile</label>
        <input type="text" name="mob" id="mob" value="<?=set_value('mob');?>" class="form-control" size="50" />
        <?=form_error('mob');?>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="<?=set_value('address');?>" class="form-control" size="50" />
        <?=form_error('address');?>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Create Account</button>
    </div>
</div><!--col-sm-12-->
</section>
