
<script src="<?php echo base_url('public'); ?>/js/jquery-1.12.3.min.js"></script>

<div class="login">
    <?php echo form_open('new_password'); ?>
    <input type="hidden" name="user_email" value="<?php echo $email; ?>">
    <table class="login_table2">
        <tr class="login_tr">
            <td colspan="5">
                <h3>New Password</h3>
            </td>
        <tr>

        <tr>
            <td>New Password</td>
            <td>
                <input type="password" class="naya" id="txtNewPassword" name="n_password" required>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; color: #d43f3a">
                <?php echo form_error('n_password');?>
            </td>
        </tr>

        <tr>
            <td>Confirm Password</td>
            <td>
                <input type="password" class="naya" id="txtConfirmPassword" name="c_password" required>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; color: #d43f3a">
                <?php echo form_error('c_password');?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button class="btn btn-primary" type="submit">Change Password</button>
            </td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>
</div><!--end of col-sm-9-->
</div><!--end of row-->
</div><!--end of container-->

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