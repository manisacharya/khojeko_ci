<div style="margin: 15px 0;">
    <?php echo $change_pwd; ?>
</div>
<div class="control-form row">
    <h3>Change Password</h3>
    <?php echo form_open('change_password'); ?>
    <div class="text-center col-sm-12">
        <input type="password" class="form-control" name="o_password" required placeholder="Current Password">
        <?php echo form_error('o_password');?>
        <input type="password" class="form-control" id="txtNewPassword" name="n_password" required placeholder="New Password">
        <?php echo form_error('n_password');?>
        <input type="password" class="form-control" id="txtConfirmPassword" name="c_password" required placeholder="Confirm Password">
        <?php echo form_error('c_password');?>
        <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
        <button class="btn btn-primary" type="submit">Change Password</button>
    </div>
    <?php echo form_close(); ?>
</div>
</div><!--end of col-sm-9-->
</div><!--end of row-->
</div><!--end of container-->

<script src="<?php echo base_url('public/js/jquery-1.12.3.min.js'); ?>"></script>
<script>
    function checkPasswordMatch() {
        var password = $("#txtNewPassword").val();
        var confirmPassword = $("#txtConfirmPassword").val();

        if (password != confirmPassword)
            $("#divCheckPasswordMatch").html("Passwords do not match!").css('color','red');
        else
            $("#divCheckPasswordMatch").html("Passwords match.").css('color','green');
    }

    $(document).ready(function () {
        $("#txtConfirmPassword").keyup(checkPasswordMatch);
    });
</script>
