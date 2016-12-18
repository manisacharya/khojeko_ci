<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery.MultiFile.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/livepreview.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery-1.12.4.min.js"></script>
<script src="<?php echo base_url('public'); ?>/js/jquery-1.12.3.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        var text_maximum = 300;
        $('#textareaa_feedback').html(text_maximum + ' characters remaining');

        $('#profile').keyup(function() {
            var text_length = $('#profile').val().length;
            var text_remaining = text_maximum - text_length;

            $('#textareaa_feedback').html(text_remaining + ' characters remaining');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        if(document.getElementById('personal').checked) { personal_div(); }
        if(document.getElementById('dealer').checked) { dealer_div(); }
        $("input[id$='personal']").click(function() { personal_div(); });
        $("input[id$='dealer']").click(function() { dealer_div(); });

        function personal_div() {
            $("#website").hide();
            $("#username").attr("disabled", true);
            $(".second_login_personal :input").attr("disabled", false);
            $(".second_login_personal").show();
            $(".second_login_dealer :input").attr("disabled", true);
            $(".second_login_dealer").hide();
        }
        function dealer_div() {
            $("#website").show();
            $("#username").attr("disabled", false);
            $(".second_login_dealer :input").attr("disabled", false);
            $(".second_login_dealer").show();
            $(".second_login_personal :input").attr("disabled", true);
            $(".second_login_personal").hide();
        }
    });
</script>

<script>
    $(document).bind("mobileinit", function() {
        $.mobile.ignoreContentEnabled = true;
    });
</script>

<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/count.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/multiple_upload.js"></script>

<div class="login_title">
    <h2>Free Registration Page </h2>
    <p>Buy and sell anything that may be 1st hand or 2nd hand stuffs, post service ads, vacancies, events, jobs, rent, real state land and building, all advertisement services are available free of cost. Enjoy.</p>

</div><!--login_title-->
<div class="post_admin">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle steps">1</a>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle steps" disabled="disabled">2</a>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle steps" disabled="disabled">3</a>
            </div>
        </div>
    </div>

    <?php echo form_open_multipart('signup'); ?>
    <div class="setup-content col-sm-12" id="step-1">
        <div class="form-group">
            <h3>Login Details:</h3>
            <div class="row">
                <div class="col-sm-3 input-title"><label>* Email :</label></div>
                <div class="col-sm-7 input-text">
                    <input type="email" name="user_email" class="naya form-control" id="useremail" value="<?php echo set_value('user_email');?>" required>
                    <?php echo form_error('user_email', '<div class="alert alert-danger">', '</div>'); ?>
                    <div class="result" id="result2"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 input-title"><label>* Password:</label></div>
                <div class="col-sm-7 input-text">
                    <?php echo form_password('password', '', 'minlength=6 class="naya form-control" id="txtNewPassword" required'); ?>
                    <?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>
                    <div class="result" id="error1"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 input-title"><label>*Re-type Password:</label></div>
                <div class="col-sm-7 input-text">
                    <?php echo form_password('re-password', '', 'minlength=6 class="naya form-control" id="txtConfirmPassword" onChange="checkPasswordMatch();" required'); ?>
                    <?php echo form_error('re-password', '<div class="alert alert-danger">', '</div>'); ?>
                    <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-3 input-title"><label>*Account Type:</label></div>
                <div class="col-sm-7 input-text">
                    <?php
                    $data_radio1 = array(
                        'name' => 'acc_type',
                        'value' => 'personal',
                        'id' => 'personal',
                        'checked' => set_radio('acc_type', 'personal',TRUE)
                    );

                    $data_radio2 = array(
                        'name' => 'acc_type',
                        'value' => 'dealer',
                        'id' => 'dealer',
                        'checked' => set_radio('acc_type', 'dealer')
                    );
                    ?>
                    <div class="col-sm-5 text-center">
                        <?php echo form_radio($data_radio1)."Personal Account<br />"; ?>
                    </div>
                    <div class="col-sm-7 text-center">
                        <?php echo form_radio($data_radio2)."Company Account"; ?>
                    </div>
                    <?php echo form_error('acc_type', '<div class="alert alert-danger">', '</div>'); ?>
                </div>
            </div>
            <div class="row" id="website">
                <div class="col-sm-3 input-title"><label>Website Address:</label></div>
                <div class="col-sm-7">
                    <?php echo form_input('user_name', set_value('user_name'), 'class="naya form-control" id="username" required'); ?>
                    <label style="margin-top: 10px;">http://www.khojeko.com/</label>
                    <?php echo form_error('user_name', '<div class="alert alert-danger">', '</div>'); ?>
                    <div class="result" id="result1"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 input-title"><label>Captcha:</label></div>
                <div class='col-sm-7 g-recaptcha' data-sitekey='6LdaZCITAAAAAJ99HnRAhCbkJ7us0MUGmXkDW94p'></div><br>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <?php
                    $data_check = array(
                        'name' => 'termsandcondition',
                        'value' => 'accept',
                        'id' => 'termsandcondition',
                        'required' => 'required',
                        'checked' => set_checkbox('termsandcondition', 'accept')
                    );
                    echo form_checkbox($data_check).'I Agree with the '."<a class='terms' href='#'>Terms and Conditions.</a>";
                    ?></div>
                <?php echo form_error('termsandcondition', '<div class="alert alert-danger">', '</div>'); ?>
                <div class="col-sm-3 input-title"></div>
                <div class="col-sm-7 text-center" id="error2"></div>
            </div>
        </div>

        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" onclick="checkRequired()">Next</button>

        <?php //echo form_submit('signup_next', 'Next', 'class="btn btn-success btn-lg pull-right"'); ?>
        <?php //echo form_close(); ?>
    </div>
    <div class="setup-content col-sm-12" id="step-2">
        <div class="form-group">
            <div class="second_login_personal">
                <h3>Personal Account</h3>
                <div class="row">
                    <div class="col-sm-3 input-title"><label>Full Name:</label></div>

                    <div class="col-sm-7">
                        <?php echo form_input('full_name', set_value('full_name'), 'id="full_name" class="naya" required'); ?>
                        <?php echo form_error('full_name', '<div class="alert alert-danger">', '</div>'); ?>
                        <div class="result" id="perror1"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label for="zone_p"> Zone:</label></div>

                    <div class="col-sm-7">
                        <select name="zone_p" id="zone_p" class="form-control" required>
                            <option>--Select Zone--</option>
                            <?php
                            foreach($zones as $row) {
                                $zone_name = $row->zone_name;
                            ?>
                                <option value="<?php echo $zone_name; ?>" <?php echo set_select('zone_p', $zone_name); ?> ><?php echo $zone_name; ?></option>
                            <?php } ?>
                        </select>
                        <div class="result" id="perror2"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title" ><label for='district_p'>Select District:</div>
                    <div class="col-sm-7">
                        <select name = 'district_p' id = 'district_p' class="form-control" required>
                            <option value="<?php echo $district_selected; ?>" selected>-- Select District --</option>
                        </select>
                        <div class="result" id="perror3"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label>Type City/Area Name:</label></div>

                    <div class="col-sm-7">
                        <?php echo form_input('city_p', set_value('city_p'), 'id="city_p" class="naya" required'); ?>
                        <?php echo form_error('city_p', '<div class="alert alert-danger">', '</div>'); ?>
                        <div class="result" id="perror4"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label>Full Address:</label></div>

                    <div class="col-sm-7">
                        <?php echo form_input('address_p', set_value('address_p'), 'id="address_p" class="naya" required'); ?>
                        <?php echo form_error('address_p', '<div class="alert alert-danger">', '</div>'); ?>
                        <div class="result" id="perror5"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label>Mobile No.:</label></div>
                    <div class="col-sm-7">
                        <?php echo form_input('mobile_p', set_value('mobile_p'), 'class="naya form-control" id="mobile_p" maxlength = 10 required'); ?>
                        <?php echo form_error('mobile_p', '<div class="alert alert-danger">', '</div>'); ?>
                        <div class="result" id="result3"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label>Another Mobile No.:</label></div>
                    <div class="col-sm-7">
                        <?php echo form_input('sec_mobile', set_value('sec_mobile'), 'class="naya" id="sec_mobile" maxlength = 10'); ?>
                        <?php echo form_error('sec_mobile', '<div class="alert alert-danger">', '</div>'); ?>
                        <div class="result" id="sec_result"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label>Tel No.:</label></div>
                    <div class="col-sm-7">
                        <?php echo form_input('telephone_p', set_value('telephone_p'), 'class="naya" id="telephone_p" maxlength = 9'); ?>
                        <?php echo form_error('telephone_p', '<div class="alert alert-danger">', '</div>'); ?>
                        <div class="result" id="tel_p_result"></div>
                    </div>
                </div>
            </div><!--second_login_personal-->

            <div class="second_login_dealer">
                <h3>Dealer Account</h3>
                <div class="row">
                    <div class="col-sm-3 input-title""><label>Dealer's Name:</label></div>
                <div class="col-sm-7">
                    <?php echo form_input('dealer_name', set_value('dealer_name'), 'id="dealer_name" class="naya" required'); ?>
                    <?php echo form_error('dealer_name', '<div class="alert alert-danger">', '</div>'); ?>
                    <div class="result" id="derror1"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Select Zone:</label></div>
                <div class="col-sm-7">
                    <select name="zone" id="zone" class="form-control" required>
                        <option>--Select Zone--</option>
                        <?php
                        foreach($zones as $row) {
                            $zone_name = $row->zone_name;
                            ?>
                            <option value="<?php echo $zone_name; ?>" <?php echo set_select('zone', $zone_name); ?> ><?php echo $zone_name; ?></option>
                        <?php } ?>
                    </select>
                    <div class="result" id="derror2"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label for="district">Select District:</label></div>
                <div class="col-sm-7">
                    <select name='district' id='district' class="form-control" required>
                        <option value="<?php echo $district_selected; ?>" selected>-- Select District --</option>
                    </select>
                    <div class="result" id="derror3"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Type City Name:</label></div>
                <div class="col-sm-7">
                    <?php echo form_input('city', set_value('city'), 'id="city" class="naya" required'); ?>
                    <?php echo form_error('city', '<div class="alert alert-danger">', '</div>'); ?>
                    <div class="result" id="derror4"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Full Address:</label></div>
                <div class="col-sm-7">
                    <?php echo form_input('address', set_value('address'), 'id="address" class="naya" required'); ?>
                    <?php echo form_error('address', '<div class="alert alert-danger">', '</div>'); ?>
                    <div class="result" id="derror5"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Mobile No.:</label></div>
                <div class="col-sm-7">
                    <?php echo form_input('mobile', set_value('mobile'), 'class="naya form-control" id="mobile_d" maxlength = 10 required'); ?>
                    <?php echo form_error('mobile', '<div class="alert alert-danger">', '</div>'); ?>
                    <div class="result" id="result4"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Tel No.:</label></div>
                <div class="col-sm-7">
                    <?php echo form_input('telephone', set_value('telephone'), 'class="naya" id="telephone" maxlength = 9'); ?>
                    <?php echo form_error('telephone', '<div class="alert alert-danger">', '</div>'); ?>
                    <div class="result" id="tel_d_result"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Company Profile:</label></div>
                <div class="col-sm-7">
                    <?php
                    $data = array(
                        'name' => 'profile',
                        'value' => set_value('profile'),
                        'rows' => 6,
                        'cols' => 25,
                        'minlength' => 20,
                        'maxlength' => 300,
                        'id' => 'profile',
                        'class'=>'form-control',
                        'required'=>'required'
                    );
                    echo form_textarea($data);
                    echo form_error('profile', '<div class="alert alert-danger">', '</div>');
                    ?>
                    <div id="textareaa_feedback"></div>
                    <div class="result" id="derror6"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Company own website address:</label></div>
                <div class="col-sm-7">
                    <?php  echo form_input('website', set_value('website'), 'class="naya form-control"'); ?>
                    <?php echo form_error('website', '<div class="alert alert-danger">', '</div>'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 input-title"><label>Dealer's logo:</label></div>
                <div class="col-sm-7" id="row1">
                    <input id="dealerlogo" type="file" name="dealerlogo" accept="image/*"  onchange="showMyImage(this,'dealerlogo','1');" required />
                    <img id="thumbnail1" />
                    <div class="result" id="derror7"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 input-title"><label>Dealer's Registration VAT/PAN scan copy:</label></div>
                <div class="col-sm-7" id="row2">
                    <input id="dealervat" type="file" name="dealervat" accept="image/*"  onchange="showMyImage(this,'dealervat','2')" required />
                    <img id="thumbnail2" />
                    <div class="result" id="derror8"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 input-title"><label>Store Front Photos(if any):</label></div>
                <div class="col-sm-7">
                    <input id="dealerstore" type="file" name="dealerstore" accept="image/*"  onchange="showMyImage(this,'dealerstore','3')" required />
                    <div class="result" id="derror9"></div>
                    <input id="dealerstore1" type="file" name="dealerstore1" accept="image/*"  onchange="showMyImage(this,'dealerstore1','4')" />
                    <input id="dealerstore2" type="file" name="dealerstore2" accept="image/*"  onchange="showMyImage(this,'dealerstore2','5')" />
                    <input id="dealerstore3" type="file" name="dealerstore3" accept="image/*"  onchange="showMyImage(this,'dealerstore3','6')" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 input-title"></div>
                <div class="col-sm-9">
                    <div id="row3" style="float:left;">
                        <img id="thumbnail3"  />
                    </div>
                    <div id="row4" style="float:left;">
                        <img id="thumbnail4" />
                    </div>
                    <div id="row5" style="float:left;">
                        <img id="thumbnail5" />
                    </div>
                    <div id="row6" style="float:left;">
                        <img id="thumbnail6" />
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary prevBtn btn-lg pull-left" type="button" >Prev</button>
        <!--                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>-->
        <?php echo form_submit('signup_next', 'Next', 'class="btn btn-success btn-lg pull-right" onclick="checkSubmit()"');
        echo form_close();
        ?>
    </div>
</div>
<div class="setup-content step-3" id="step-3">
    <div class="form-group">
        <h3>Step 3</h3>


        <div class="message">
            <a id="success-message">Congratulation your account is successfully created.</a>
            <a id="unsuccess-message">Please check your email and verify your account soon.</a>
        </div>

        <!--input class="btn btn-success btn-lg pull-right" type="submit" value="Done!"></input-->
    </div>
</div>
<?php echo form_close(); ?>

</div><!--end of post_admin-->
</div><!--guts-->

</div>
</div>

<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/signup_ajax.js"></script>

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
<script type="text/javascript">
    $('#butn').on('click', function() {
        $("#form1").valid();
    });
</script>