
<div class="col-sm-12">
    <?php echo form_open('admin/change_password', array('class'=>'form')); ?>
    <?php echo $message;?>
    <div class="form-group">
        <label for="current_password">Current Password</label>
        <input type="password" name="current_password" id="current_password" class="form-control" size="50" />
        <?=form_error('current_password');?>
    </div>

    <div class="form-group">
        <label for="password">New Password</label>
        <input type="password" name="password" id="password" class="form-control" size="50" />
        <?=form_error('password');?>
    </div>
    <div class="form-group">
        <label for="pass_confirm">Password Confirm</label>
        <input type="password" name="pass_confirm" id="pass_confirm" class="form-control" size="50" />
        <?=form_error('pass_confirm');?>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default">Change</button>
    </div>
</div><!--col-sm-12-->
</section>
