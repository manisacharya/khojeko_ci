<div style="margin: 15px 0;">
    <?php echo $email;?>
</div>
<div class="control-form row">
    <h3>Lost Password</h3>
    <?php echo form_open('lost_password'); ?>
    <div class="text-center col-sm-12">
        <input type="email" class="form-control" name="useremail" value="<?php echo set_value('useremail');?>" required placeholder="Your Email">
        <?php echo form_error('useremail');?>

        <button class="btn btn-primary" type="submit">Send Email</button>
    </div>
    <?php echo form_close(); ?>
</div>

</div><!--end of col-sm-9-->
</div><!--end of row-->
</div><!--end of container-->