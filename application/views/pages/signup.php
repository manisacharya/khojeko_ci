
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
            $(".second_login_dealer").hide();
            $("#website").hide();

            $("input[id$='personal']").click(function() {
                $("#website").hide();
                $(".second_login_personal").show();
                $(".second_login_dealer").hide();

            })
            $("input[id$='dealer']").click(function() {
                $("#website").show();
                $(".second_login_dealer").show();
                $(".second_login_personal").hide();
            })

        });
    </script>

    <script>
        $(document).bind("mobileinit", function() {
            $.mobile.ignoreContentEnabled = true;
        });
    </script>
    <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/ad_detail_slider.js"></script>
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
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle steps">1.Login Details</a>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle steps" disabled="disabled">2.Profile</a>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle steps" disabled="disabled">3.Done</a>
                    </div>
                </div>
            </div>

            <?php
            echo form_open_multipart('details_validation');
            //echo validation_errors();
            ?>
            <div class="setup-content" id="step-1">
                <div class="form-group">
                    <table class="login_table">
                        <h3>Login Details:</h3>

                        <tr>
                            <td>
                                <label class="control-label">*Username:</label>
                            </td>
                            <td>
                                <?php echo form_input('user_name', $this->input->post('user_name'), 'required class="naya form-control" id="username"'); ?>
                                <?php echo form_error('user_name', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                <div class="result" id="result1" ></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                *User email:
                            </td>
                            <td>
                                <!--input type="email" name="user_email" required class="naya"-->
                                <?php echo form_input('user_email', $this->input->post('user_email'), 'required class="naya form-control" id="useremail"');?>
                                <?php echo form_error('user_email', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                <div class="result" id="result2"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                *Password:
                            </td>
                            <td>
                                <?php echo form_password('password', '', 'required class="naya form-control" id="txtNewPassword"'); ?>
                                <?php echo form_error('password', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                <!--input type="password" required class="naya"-->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                *Re-type Password:
                            </td>
                            <td>
                                <?php echo form_password('re-password', '', 'required class="naya form-control" id="txtConfirmPassword" onChange="checkPasswordMatch();"'); ?>
                                <br>
                                <?php echo form_error('re-password', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <a>*Account Type:</a>
                            </td>
                            <td>
                                <?php
                                $data_radio1 = array(
                                    'name' => 'acc_type',
                                    'value' => 'personal',
                                    'id' => 'personal',
                                    'checked' => TRUE
                                );
                                echo form_radio($data_radio1)."Personal Ac<br />";
                                $data_radio2 = array(
                                    'name' => 'acc_type',
                                    'value' => 'dealer',
                                    'id' => 'dealer'
                                );
                                echo form_radio($data_radio2)."Company Ac(Distributed/Dealer/Retail)";
                                ?>
                                <?php echo form_error('acc_type', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                            </td>
                        </tr>
                    </table>
                    <div id="website">
                        Website Address: http://www.khojeko.com/<?php echo form_input('website', $this->input->post('website'), 'class="naya"'); ?><br>
                    </div>
                    <a>Captcha:</a>
                    <div class='g-recaptcha' data-sitekey='6LdaZCITAAAAAJ99HnRAhCbkJ7us0MUGmXkDW94p'></div><br><br>

                    <?php echo form_checkbox('termsandcondition', 'accept', '', 'required checked').'I Agree with the '."<a class='terms' href='#'>Terms and Conditions.</a>"; ?>
                    <?php echo form_error('termsandcondition', '<div class="error" style="color: #ff000f">', '</div>'); ?>

                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" style="float:left">Next</button>

                    <?php //echo form_submit('signup_next', 'Next', 'class="btn btn-success btn-lg pull-right"'); ?>
                    <?php //echo form_close(); ?>
                </div>
            </div>
            <div class="setup-content" id="step-2">
                <div class="form-group">
                    <div class="second_login_personal">

                        <table class="login_table">
                            <h3>Personal Account</h3>
                            <tr>
                                <td>
                                    Full Name:
                                </td>

                                <td>
                                    <?php echo form_input('full_name', $this->input->post('full_name'), 'class="naya"'); ?>
                                    <?php echo form_error('full_name', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Select Zone:
                                </td>

                                <td>
                                    <?php
                                    $options_z = array(
                                        'Bagmati' =>'Bagmati',              'Bheri' => 'Bheri',
                                        'Dhawalagiri' => 'Dhawalagiri',     'Gandaki' => 'Gandaki',
                                        'Janakpur' => 'Janakpur',           'Karnali' => 'Karnali',
                                        'Koshi' => 'Koshi',                 'Lumbini' => 'Lumbini',
                                        'Mahakali' => 'Mahakali',           'Mechi' => 'Mechi',
                                        'Narayani' => 'Narayani',           'Rapti' => 'Rapti',
                                        'Sagarmatha' => 'Sagarmatha',       'Seti' => 'Seti'
                                    );
                                    echo form_dropdown('zone_p', $options_z, $this->input->post('zone'));
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Select District:
                                </td>

                                <td>
                                    <?php
                                    $options_d = array(
                                        'Achham' => 'Achham',               'Arghakhanchi' => 'Arghakhanchi',       'Baglung' => 'Baglung',
                                        'Baitadi' => 'Baitadi',             'Bajhang' => 'Bajhang',                 'Bajura' => 'Bajura',
                                        'Banke' => 'Banke',                 'Bara' => 'Bara',                       'Bardiya' => 'Bardiya',
                                        'Bhaktapur' => 'Bhaktapur',         'Bhojpur' => 'Bhojpur',                 'Chitwan' => 'Chitwan',
                                        'Dadeldhura' => 'Dadeldhura',       'Dailekh' => 'Dailekh',                 'Dang' => 'Dang',
                                        'Darchula' => 'Darchula',           'Dhading' => 'Dhading',                 'Dhankuta' => 'Dhankuta',
                                        'Dhanusa' => 'Dhanusa',             'Dholkha' => 'Dholkha',                 'Dolpa' => 'Dolpa',
                                        'Doti' => 'Doti',                   'Gorkha' => 'Gorkha',                   'Gulmi' => 'Gulmi',
                                        'Humla' => 'Humla',                 'Ilam' => 'Ilam',                       'Jajarkot' => 'Jajarkot',
                                        'Jhapa' => 'Jhapa',                 'Jumla' => 'Jumla',                     'Kailali' => 'Kailali',
                                        'Kalikot' => 'Kalikot',             'Kanchanpur' => 'Kanchanpur',           'Kapilvastu' => 'Kapilvastu',
                                        'Kaski' => 'Kaski',                 'Kathmandu' => 'Kathmandu',             'Kavrepalanchok' => 'Kavrepalanchok',
                                        'Khotang' => 'Khotang',             'Lalitpur' => 'Lalitpur',               'Lamjung' => 'Lamjung',
                                        'Mahottari' => 'Mahottari',         'Makwanpur' => 'Makwanpur',             'Manang' => 'Manang',
                                        'Morang' => 'Morang',               'Mugu' => 'Mugu',                       'Mustang' => 'Mustang',
                                        'Myagdi' => 'Myagdi',               'Nawalparasi' => 'Nawalparasi',         'Nuwakot' => 'Nuwakot',
                                        'Okhaldhunga' => 'Okhaldhunga',     'Palpa' => 'Palpa',                     'Panchthar' => 'Panchthar',
                                        'Parbat' => 'Parbat',               'Parsa' => 'Parsa',                     'Pyuthan' => 'Pyuthan',
                                        'Ramechhap' => 'Ramechhap',         'Rasuwa' => 'Rasuwa',                   'Rautahat' => 'Rautahat',
                                        'Rolpa' => 'Rolpa',                 'Rukum' => 'Rukum',                     'Rupandehi' => 'Rupandehi',
                                        'Salyan' => 'Salyan',               'Sankhuwasabha' => 'Sankhuwasabha',     'Saptari' => 'Saptari',
                                        'Sarlahi' => 'Sarlahi',             'Sindhuli' => 'Sindhuli',               'Sindhupalchok' => 'Sindhupalchok',
                                        'Siraha' => 'Siraha',               'Solukhumbu' => 'Solukhumbu',           'Sunsari' => 'Sunsari',
                                        'Surkhet' => 'Surkhet',             'Syangja' => 'Syangja',                 'Tanahu' => 'Tanahu',
                                        'Taplejung' => 'Taplejung',         'Terhathum' => 'Terhathum',             'Udayapur' => 'Udayapur'
                                    );
                                    echo form_dropdown('district_p', $options_d, $this->input->post('district'));
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Type City/Area Name:
                                </td>

                                <td>
                                    <?php echo form_input('city_p', $this->input->post('city_p'), 'class="naya"'); ?>
                                    <?php echo form_error('city_p', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Full Address:
                                </td>

                                <td>
                                    <?php echo form_input('address_p', $this->input->post('address_p'), 'class="naya"'); ?>
                                    <?php echo form_error('address_p', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Mobile No.:
                                </td>

                                <td>
                                    <?php echo form_input('mobile_p', $this->input->post('mobile_p'), 'class="naya form-control" id="mobile_p"'); ?>
                                    <div class="result" id="result3"></div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Another Mobile No.:
                                </td>

                                <td>
                                    <?php echo form_input('sec_mobile', $this->input->post('sec_mobile'), 'class="naya"'); ?>
                                    <?php echo form_error('sec_mobile', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Tel No.:
                                </td>

                                <td>
                                    <?php echo form_input('telephone_p', $this->input->post('telephone_p'), 'class="naya"'); ?>
                                    <?php echo form_error('telephone_p', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                </td>
                            </tr>

                        </table>
                    </div><!--second_login_personal-->

                    <div class="second_login_dealer">

                        <table class="login_table">
                            <h3>Dealer Account</h3>
                            <tr>
                                <td>
                                    Dealer's Name:
                                </td>

                                <td>
                                    <?php echo form_input('dealer_name', $this->input->post('dealer_name'), 'class="naya"'); ?>
                                    <?php echo form_error('dealer_name', '<div class="error" style="color:red">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Select Zone:
                                </td>

                                <td>
                                    <?php echo form_dropdown('zone', $options_z, $this->input->post('zone'));?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Select District:
                                </td>

                                <td>
                                    <?php echo form_dropdown('district', $options_d, $this->input->post('district')); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Type City Name:
                                </td>

                                <td>
                                    <?php echo form_input('city', $this->input->post('city'), 'class="naya"'); ?>
                                    <?php echo form_error('city', '<div class="error" style="color:red">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Full Address:
                                </td>

                                <td>
                                    <?php echo form_input('address', $this->input->post('address'), 'class="naya"'); ?>
                                    <?php echo form_error('address', '<div class="error" style="color:red">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Mobile No.:
                                </td>

                                <td>
                                    <?php echo form_input('mobile', $this->input->post('mobile'), 'class="naya form-control" id="mobile_d"'); ?>
                                    <?php echo form_error('mobile', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                    <div class="result" id="result4"></div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Tel No.:
                                </td>

                                <td>
                                    <?php echo form_input('telephone', $this->input->post('telephone'), 'class="naya"'); ?>
                                    <?php echo form_error('telephone', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Company Profile and deals in:
                                </td>

                                <td>
                                    <?php
                                    $data = array(
                                        'name' => 'profile',
                                        'value' => $this->input->post('profile'),
                                        'rows' => 6,
                                        'cols' => 25,
                                        'maxlength' => 300,
                                        'id' => 'profile'
                                    );
                                    echo form_textarea($data);
                                    ?>
                                    <?php echo form_error('profile', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                    <div id="textarea_feedback"></div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Company own website address:
                                </td>

                                <td>
                                    <?php  echo form_input('website', $this->input->post('website')); ?>
                                    <?php echo form_error('website', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                </td>
                            </tr>
                        </table>
                        Dealer's logo:
                        <input type="file" name="dealerlogo" accept="image/*"  onchange="showMyImage(this)" />
                        <br/>
                        <!--                            <img id="thumbnil" style="width:20%; margin-top:10px;"  src="" alt="image"/><br>-->

                        Dealer's Registration VAT/PAN scan copy:
                        <input type="file" name="dealervat" accept="image/*"  onchange="showMeImage(this)" />
                        <br/>
                        <!--                            <img id="thumbnail" class="img-rounded"  src="" alt="image"/><br>-->


                        <div id="dynamic_field">
                            <div class="row">
                                <div class="col-md-10">
                                    Store Front Photos(if any):
                                    <input type="file" name="dealerstore" accept="image/*"  onchange="showMyImage(this)" />
                                </div>
                                <div class="col-md-2">
                                    <button type="button" name="add" id="add" class="btn btn-primary btn-xs pull-right">Add More Photos (Maximum 4)</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                    <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                    <!--                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>-->
                    <?php echo form_submit('signup_next', 'Next', 'class="btn btn-success btn-lg pull-right"');
                    echo form_close();
                    ?>
                </div>
            </div>
            <div class="setup-content step-3" id="step-3">
                <div class="form-group">
                    <h3> Step 3</h3>


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
                            Result.html('<span class="success">Username available</span>').css('color','green');
                        }
                        else if(responseText > 0){
                            Result.html('<span class="error">Username already taken.<br>Please choose another username.</span>').css('color','red');
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
            var useremail = $(this).val(); // Get username textbox using $(this)
            var Result = $('#result2'); // Get ID of the result DIV where we display the results
            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if(reg.test($(this).val())) { // check email format
                Result.html('Loading...'); // you can use loading animation here
                var dataPass = 'action=availability&useremail='+useremail;
                $.ajax({ // Send the username val to available.php
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
            if(username.length == 0) {
                Result.html('');
            }
        });

        $('#mobile_p').keyup(function(){
            var mobile_p = $(this).val(); // Get primary mobile number of personal textbox using $(this)
            var Result = $('#result3'); // Get ID of the result DIV where we display the results
            if(mobile_p.length > 9) { // if greater than 2 (minimum 3)
                Result.html('Loading...'); // you can use loading animation here
                var dataPass = 'action=availability&mobile_p='+mobile_p;
                $.ajax({ // Send the username val to available.php
                    type : 'POST',
                    data : dataPass,
                    url  : 'available_mobile_P',
                    success: function(responseText){ // Get the result
                        if(responseText == 0){
                            Result.html('<span class="success">This mobile number can be used</span>').css('color','green');
                        }
                        else if(responseText > 0){
                            Result.html('<span class="error">Mobile number already used.<br>Please enter another mobile number.</span>').css('color','red');
                        }
                        else{
                            alert('Problem with sql query');
                        }
                    }
                });
            }else{
                Result.html('Enter atleast 10 digits');
            }
            if(mobile_p.length == 0) {
                Result.html('');
            }
        });

        $('#mobile_d').keyup(function(){
            var mobile_d = $(this).val(); // Get primary mobile number of personal textbox using $(this)
            var Result = $('#result4'); // Get ID of the result DIV where we display the results
            if(mobile_d.length > 9) { // if greater than 2 (minimum 3)
                Result.html('Loading...'); // you can use loading animation here
                var dataPass = 'action=availability&mobile_d='+mobile_d;
                $.ajax({ // Send the username val to available.php
                    type : 'POST',
                    data : dataPass,
                    url  : 'available_mobile_d',
                    success: function(responseText){ // Get the result
                        if(responseText == 0){
                            Result.html('<span class="success">This mobile number can be used</span>').css('color','green');
                        }
                        else if(responseText > 0){
                            Result.html('<span class="error">Mobile number already used.<br>Please enter another mobile number.</span>').css('color','red');
                        }
                        else{
                            alert('Problem with sql query');
                        }
                    }
                });
            }else{
                Result.html('Enter 10 digits');
            }
            if(mobile_d.length == 0) {
                Result.html('');
            }
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
<script>
    $(window).load(function(){
        var i=1;
        $('#add').click(function(){
            //i++;
            if(i<=3) {
                $('#dynamic_field').append('<div class="row"><div class="col-md-10"><input type="file" name="dealerstore'+i+'" accept="image/*"  onchange="showMyImage(this)" /></div></div>');
                i++;
            }
        });
    });
</script>