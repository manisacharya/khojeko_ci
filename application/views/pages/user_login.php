
                <div class="login">
                    <?php echo form_open('login'); ?>
                    <table class="login_table2">
                        <tr class="login_tr">
                            <td colspan="5">
                                <h3>Login</h3>
                            </td>
                        <tr>

                        <tr>
                            <td>Username</td>
                            <td>
                                <input type="text"  class="naya" name="user_name" value="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; color: #d43f3a">
                                <?php echo form_error('user_name');?>
                            </td>
                        </tr>

                        <tr>
                            <td>Password</td>
                            <td>
                                <input type="Password"  class="naya" name="password">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"  style="text-align: center; color: #d43f3a">
                                <?php echo form_error('password');?>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <button class="btn btn-primary" type="submit">Login</button>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <a href="#" class="Lost">Lost my password ?</a>
                            </td>
                        </tr>
                    </table>
                    <?php echo form_close(); ?>
                </div>
            </div><!--end of col-sm-9-->
        </div><!--end of row-->
     </div><!--end of container-->