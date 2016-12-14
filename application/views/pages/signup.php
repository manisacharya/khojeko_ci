<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery.MultiFile.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/livepreview.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery-1.12.4.min.js"></script>
<script src="<?php echo base_url('public'); ?>/js/hawa.js"></script>
<script src="<?php echo base_url('public'); ?>/js/jquery-1.12.3.min.js"></script>

<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        var text_max = 300;
        $('#textarea_feedback').html(text_max + ' characters remaining');

        $('#profile').keyup(function() {
            var text_length = $('#profile').val().length;
            var text_remaining = text_max - text_length;

            $('#textarea_feedback').html(text_remaining + ' characters remaining');
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
            $(".second_login_personal").show();
            $(".second_login_dealer").hide();
        }
        function dealer_div() {
            $("#website").show();
            $(".second_login_dealer").show();
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
                    <?php echo form_password('password', '', 'class="naya form-control" id="txtNewPassword" required'); ?>
                    <?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>
                    <div class="result" id="error1"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 input-title"><label>*Re-type Password:</label></div>
                <div class="col-sm-7 input-text">
                    <?php echo form_password('re-password', '', 'class="naya form-control" id="txtConfirmPassword" onChange="checkPasswordMatch();" required'); ?>
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
                    <?php echo form_input('user_name', set_value('user_name'), 'class="naya form-control" id="username"'); ?>
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
            </div>
            <div class="result" id="error2"></div>
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
                        <?php echo form_input('full_name', set_value('full_name'), 'class="naya"'); ?>
                        <?php echo form_error('full_name', '<div class="alert alert-danger">', '</div>'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label for="zone_p"> Zone:</label></div>

                    <div class="col-sm-7">
                        <?php
                        $options_z = array();
                        $options_z[] = "--Select Zone--";

                        foreach($zones as $row) {
                            $options_z[$row->zone_name] = $row->zone_name;
                        }
                        echo form_dropdown('zone_p', $options_z, set_value('zone'), ' id="zone_p" class="form-control"');
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title" ><label for='district_p'>Select District:</div>
                    <div class="col-sm-7">
                        <select name = 'district_p' id = 'district_p' class="form-control">
                            <option value="">-- Select District --</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label>Type City/Area Name:</label></div>

                    <div class="col-sm-7">
                        <?php echo form_input('city_p', set_value('city_p'), 'class="naya"'); ?>
                        <?php echo form_error('city_p', '<div class="alert alert-danger">', '</div>'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label>Full Address:</label></div>

                    <div class="col-sm-7">
                        <?php echo form_input('address_p', set_value('address_p'), 'class="naya"'); ?>
                        <?php echo form_error('address_p', '<div class="alert alert-danger">', '</div>'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label>Mobile No.:</label></div>
                    <div class="col-sm-7">
                        <?php echo form_input('mobile_p', set_value('mobile_p'), 'class="naya form-control" id="mobile_p" maxlength = 10'); ?>
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
                    <?php echo form_input('dealer_name', set_value('dealer_name'), 'class="naya"'); ?>
                    <?php echo form_error('dealer_name', '<div class="alert alert-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Select Zone:</label></div>
                <div class="col-sm-7">
                    <?php echo form_dropdown('zone', $options_z, set_value('zone'), ' id="zone"');?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label for="district">Select District:</label></div>
                <div class="col-sm-7">
                    <select name='district' id='district'>
                        <option value="">-- Select District --</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Type City Name:</label></div>
                <div class="col-sm-7">
                    <?php echo form_input('city', set_value('city'), 'class="naya"'); ?>
                    <?php echo form_error('city', '<div class="alert alert-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Full Address:</label></div>
                <div class="col-sm-7">
                    <?php echo form_input('address', set_value('address'), 'class="naya"'); ?>
                    <?php echo form_error('address', '<div class="alert alert-danger">', '</div>'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 input-title"><label>Mobile No.:</label></div>
                <div class="col-sm-7">
                    <?php echo form_input('mobile', set_value('mobile'), 'class="naya form-control" id="mobile_d" maxlength = 10'); ?>
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
                        'maxlength' => 300,
                        'id' => 'profile',
                        'class'=>'form-control'
                    );
                    echo form_textarea($data);
                    echo form_error('profile', '<div class="alert alert-danger">', '</div>');
                    ?>
                    <div id="textarea_feedback"></div>
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
                    <input id="dealerlogo" type="file" name="dealerlogo" accept="image/*"  onchange="showMyImage(this,'dealerlogo','1');" />
                    <img id="thumbnail1" />
                    <?php echo form_error('dealerlogo', '<div class="alert alert-danger">', '</div>'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 input-title"><label>Dealer's Registration VAT/PAN scan copy:</label></div>
                <div class="col-sm-7" id="row2">
                    <input id="dealervat" type="file" name="dealervat" accept="image/*"  onchange="showMyImage(this,'dealervat','2')" />
                    <img id="thumbnail2" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 input-title"><label>Store Front Photos(if any):</label></div>
                <div class="col-sm-7">
                    <input id="dealerstore" type="file" name="dealerstore" accept="image/*"  onchange="showMyImage(this,'dealerstore','3')" />
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
        <?php echo form_submit('signup_next', 'Next', 'class="btn btn-success btn-lg pull-right"');
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#txtNewPassword').keyup(function(){
            $('#error1').hide();
        });

        $('#termsandcondition').click(function(){
            $('#error2').hide();
        });

        $('#username').keyup(function(){
            var username = $(this).val(); // Get username textbox using $(this)
            var Result = $('#result1'); // Get ID of the result DIV where we display the results
            if(username.length > 2) { // if greater than 2 (minimum 3)
                Result.html('Loading...'); // you can use loading animation here
                var dataPass = 'action=availability&username='+username;

                $.ajax({ // Send the username val to available.php
                    type : 'POST',
                    data : dataPass,
                    url  : 'available_username',
                    success: function(responseText){ // Get the result
                        if(responseText == 0){
                            Result.html('<span class="success">Website Address available</span>').css('color','green');
                        }
                        else if(responseText > 0){
                            Result.html('<span class="error">Website Address already taken.<br>Please choose another username.</span>').css('color','red');
                        }
                        else{
                            alert('Problem with sql query');
                        }
                    }
                });
            }else{
                Result.html('Enter atleast 3 characters');
            }
            if(username.length == 0) {
                Result.html('');
            }
        });

        $('#useremail').keyup(function(){
            var useremail = $(this).val(); // Get useremail textbox using $(this)
            var Result = $('#result2'); // Get ID of the result DIV where we display the results
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if(reg.test($(this).val())) { // check email format
                Result.html('Loading...'); // you can use loading animation here
                var dataPass = 'action=availability&useremail='+useremail;
                $.ajax({ // Send the useremail val to available.php
                    type : 'POST',
                    data : dataPass,
                    url  : 'available_email',
                    success: function(responseText){ // Get the result
                        if(responseText == 0){
                            Result.html('<span class="success">User email available</span>').css('color','green');
                        }
                        else if(responseText > 0){
                            Result.html('<span class="error">User email already taken.<br>Please choose another user email.</span>').css('color','red');
                        }
                        else{
                            alert('Problem with sql query');
                        }
                    }
                });
            }else{
                Result.html('Enter valid email address').css('color','red')
            }
            if(useremail.length == 0) {
                Result.html('');
            }
        });

        $('#mobile_p').keyup(function(){
            var mobile_p = $(this).val(); // Get primary mobile number of personal textbox using $(this)
            var Result = $('#result3'); // Get ID of the result DIV where we display the results
            var reg = /^([0-9])+$/;
            if((reg.test($(this).val()))) { // check number format
                if(mobile_p.length > 9) { // if greater than 9 (minimum 10)
                    Result.html('Loading...'); // you can use loading animation here
                    var dataPass = 'action=availability&mobile_p=' + mobile_p;
                    $.ajax({
                        type: 'POST',
                        data: dataPass,
                        url: 'available_mobile_P',
                        success: function (responseText) { // Get the result
                            if (responseText == 0) {
                                Result.html('<span class="success">This mobile number can be used</span>').css('color', 'green');
                            } else if (responseText > 0) {
                                Result.html('<span class="error">Mobile number already used.<br>Please enter another mobile number.</span>').css('color', 'red');
                            } else {
                                alert('Problem with sql query');
                            }
                        }
                    });
                } else {
                    Result.html('Mobile number must have 10 digits').css('color','#ff5500');
                }
            }else{
                Result.html('Please enter only numbers').css('color','red');
            }
            if(mobile_p.length == 0) {
                Result.html('');
            }
        });

        $('#sec_mobile').keyup(function(){
            var sec_mobile = $(this).val(); // Get primary mobile number of personal textbox using $(this)
            var Result = $('#sec_result'); // Get ID of the result DIV where we display the results
            var reg = /^([0-9])+$/;
            if((reg.test($(this).val()))) { // check number format
                if(sec_mobile.length < 10) { // if greater than 9 (minimum 10)
                    Result.html('Mobile number must have 10 digits').css('color','#ff5500');
                } else {
                    Result.html('<span class="success">This mobile number can be used</span>').css('color', 'green');
                }
            }else{
                Result.html('Please enter only numbers').css('color','red');
            }
        });

        $('#telephone_p').keyup(function(){
            var telephone_p = $(this).val(); // Get primary mobile number of personal textbox using $(this)
            var Result = $('#tel_p_result'); // Get ID of the result DIV where we display the results
            var reg = /^([0-9])+$/;
            if((reg.test($(this).val()))) { // check number format
                if(telephone_p.length < 7) { // if greater than 9 (minimum 10)
                    Result.html('Telephone number must have 7 digits').css('color','#ff5500');
                } else {
                    Result.html('<span class="success">This telephone number can be used</span>').css('color', 'green');
                }
            }else{
                Result.html('Please enter only numbers').css('color','red');
            }
        });

        $('#zone_p').change(function(){
            var zone = $(this).val();
            var dataPass = 'action=availability&zone=' + zone;
            $.ajax({
                type: 'POST',
                data: dataPass,
                url: 'get_districts',
                success: function(html){
                    $("#district_p").html("");
                    $("#district_p").html(html);
                }
            });
        });

        $('#mobile_d').keyup(function(){
            var mobile_d = $(this).val(); // Get primary mobile number of personal textbox using $(this)
            var Result = $('#result4'); // Get ID of the result DIV where we display the results
            var reg = /^([0-9])+$/;
            if((reg.test($(this).val()))) { // check number format
                if (mobile_d.length > 9) { // if greater than 9 (minimum 10)
                    Result.html('Loading...'); // you can use loading animation here
                    var dataPass = 'action=availability&mobile_d=' + mobile_d;
                    $.ajax({
                        type: 'POST',
                        data: dataPass,
                        url: 'available_mobile_d',
                        success: function (responseText) { // Get the result
                            if (responseText == 0) {
                                Result.html('<span class="success">This mobile number can be used</span>').css('color', 'green');
                            } else if (responseText > 0) {
                                Result.html('<span class="error">Mobile number already used.<br>Please enter another mobile number.</span>').css('color', 'red');
                            } else {
                                alert('Problem with sql query');
                            }
                        }
                    });
                } else {
                    Result.html('Mobile number must have 10 digits').css('color','#ff5500');
                }
            }else{
                Result.html('Please enter only numbers').css('color','red');
            }
            if(mobile_d.length == 0) {
                Result.html('');
            }
        });

        $('#telephone').keyup(function(){
            var telephone = $(this).val(); // Get primary mobile number of personal textbox using $(this)
            var Result = $('#tel_d_result'); // Get ID of the result DIV where we display the results
            var reg = /^([0-9])+$/;
            if((reg.test($(this).val()))) { // check number format
                if(telephone.length < 7) { // if greater than 9 (minimum 10)
                    Result.html('Telephone number must have 7 digits').css('color','#ff5500');
                } else {
                    Result.html('<span class="success">This telephone number can be used</span>').css('color', 'green');
                }
            }else{
                Result.html('Please enter only numbers').css('color','red');
            }
        });

        $('#zone').change(function(){
            var zone = $(this).val();
            var dataPass = 'action=availability&zone=' + zone;
            $.ajax({
                type: 'POST',
                data: dataPass,
                url: 'get_district',
                success: function(html){
                    $("#district").html("");
                    $("#district").html(html);
                }
            });
        });
    });
</script>

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