
<script src="<?php echo base_url('public'); ?>/js/jquery-1.12.3.min.js"></script>

<div>
    <?php echo $change_pwd; ?>
</div>
<div class="login">
    <?php echo form_open('change_password'); ?>
    <table class="login_table2">
        <tr class="login_tr">
            <td colspan="5">
                <h3>Change Password</h3>
            </td>
        <tr>

        <tr>
            <td>Old Password</td>
            <td>
                <input type="password" class="naya" name="o_password" required>
            </td>
        </tr>

        <tr>
            <td>New Password</td>
            <td>
                <input type="password" class="naya" id="txtNewPassword" name="n_password" required>
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
                <?php echo validation_errors();?>
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