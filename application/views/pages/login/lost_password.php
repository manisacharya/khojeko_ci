
<div class="login">
    <?php echo form_open('lost_password'); ?>
    <table class="login_table2">
        <tr class="login_tr">
            <td colspan="5">
                <h3>Lost Password</h3>
            </td>
        <tr>

        <tr>
            <td>Email</td>
            <td>
                <input type="email"  class="naya" name="useremail" required>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; color: #d43f3a">
                <?php echo form_error('useremail');?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button class="btn btn-primary" type="submit">Send Email</button>
            </td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>
<div>
    <?php echo $email;?>
</div>
</div><!--end of col-sm-9-->
</div><!--end of row-->
</div><!--end of container-->