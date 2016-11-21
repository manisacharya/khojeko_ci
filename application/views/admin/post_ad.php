<?php
   echo $this->session->flashdata('message');
   echo $this->session->flashdata('error');
?>
  
    <div class="col-sm-12">
    	<h3>Post Ad By Admin</h3>
        <div class="post_admin">
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle steps">1</a>
                        <p>Step 1</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle steps" disabled="disabled">2</a>
                        <p>Step 2</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle steps" disabled="disabled">3</a>
                        <p>Step 3</p>
                    </div>
                     <div class="stepwizard-step">
                        <a href="#step-4" type="button" class="btn btn-default btn-circle steps" disabled="disabled">4</a>
                        <p>Step 4</p>
                    </div>
                </div>
            </div>

            <?php 
                $attributes = array('id' => 'adminPostAd');
                echo form_open_multipart("admin/post_ad", $attributes);
                echo validation_errors();
            ?>

                <div class="setup-content" id="step-1">
                    <div class="form-group">
                        <table>
                            <tr>
                                <h3> Step 1&nbsp;&nbsp;(Fill Details)</h3>
                            </tr>

                             <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*Ad Owner Name</label>"; ?>    
                                </td>
                                <td>
                                    <?php echo form_input('owner_name', $this->input->post('owner_name'), 'maxlength="100" class="form-control" placeholder="Enter Owner Name" required'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <?php echo "<label class='control-label' name='email_check'>*Email</label>"; ?>    
                                </td>
                                <td>
                                    <?php echo form_input('email', $this->input->post('email'), 'maxlength="100" class="form-control" id="email" placeholder="Enter Email" autofocus required'); ?>
                                    <div class="result" id="result2"></div>

                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*User Name</label>"; ?>    
                                </td>
                                <td>
                                    <?php echo form_input('username', $this->input->post('username'), 'maxlength="100" class="form-control" id="username" placeholder="Enter User Name" required'); ?>
                                    <div class="result" id="result1" ></div>
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*Password</label>"; ?>    
                                </td>
                                <td>
                                    <?php 
                                    $data = array(
                                                  'name'        => 'password',
                                                  'type'        => 'password',
                                                  'id'          => 'password',
                                                  'class'       => 'form-control',
                                                  'placeholder' => 'Password',
                                                  'required'    => 'required',
                                                  'maxlength'   => '100'
                                                );

                                    echo form_input($data);
                                    // echo form_input('password', $this->input->post('password'), 'maxlength="100" class="form-control" id="password" placeholder="Password" type="password" required'); ?>
                                    <a onclick="toggle_password('password');" id="showhide">Show</a>
                                    <?php echo form_error('password', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                    <span id="strength"></span>
                                </td>
                            </tr>
                        
                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*Retype Password</label>"; ?>    
                                </td>
                                <td>
                                    <?php
                                    $data1 = array(
                                                  'name'        => 're_password',
                                                  'type'        => 'password',
                                                  'id'          => 're_password',
                                                  'class'       => 'form-control',
                                                  'placeholder' => 'Retype Password',
                                                  'required'    => 'required',
                                                  'maxlength'   => '100',
                                                  'onChange'    => 'checkPasswordMatch();'
                                                );

                                    echo form_input($data1);

                                    //echo form_input('re_password', $this->input->post('re_password'), 'maxlength="100" class="form-control" id="re_password" placeholder="Retype Password" type="password" required'); 
                                    echo form_error('re-password', '<div class="error" style="color: #ff000f">', '</div>'); ?>
                                    <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>

                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*Zone</label>"; ?>    
                                </td>
                                <td>
                                    <select name="zone" class="select">
                                            <option>Mechi</option>
                                            <option>Koshi</option>
                                            <option>Sagarmatha</option>
                                            <option>Janakpur</option>
                                            <option>Bagmati</option>
                                            <option>Narayani</option>
                                            <option>Gandaki</option>
                                            <option>Lumbini</option>
                                            <option>Dhaulagiri</option>
                                            <option>Rapti</option>
                                            <option>Karnali</option>
                                            <option>Bheri</option>
                                            <option>Seti</option>
                                            <option>Mahakali</option>
                                    </select>                      
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*District</label>"; ?>    
                                </td>
                                <td>
                                    <select name="district" class="select">
                                        <option>Kathmandu</option>
                                        <option>Lalitpur</option>
                                        <option>Bhaktapur</option>
                                        <option>Jhapa</option>
                                        <option> Gorkha</option>
                                        <option>Kaski</option>
                                        <option>Lamjung</option>
                                        <option>Syangja</option>
                                        <option>Tanahun</option>
                                        <option>Manang</option>
                                        <option>Okhaldhunga</option>
                                        <option>Khotang</option>
                                        <option> Udayapur</option>
                                        <option>Siraha</option>
                                        <option> Saptari</option>
                                        <option>Solukhumbu</option>
                                        <option> Dhanusa</option>
                                        <option>Mahottari</option>
                                        <option> Sarlahi</option>
                                        <option>Sindhuli</option>
                                        <option>Ramechhap</option>
                                        <option>Dolakha</option>
                                        <option>Dhading</option>
                                        <option>Kavrepalanchok</option>
                                        <option>Nuwakot</option>
                                        <option>Rasuwa</option>
                                        <option>Sindhupalchok</option>
                                        <option>Bara</option>
                                        <option> Parsa</option>
                                        <option>Rautahat</option>
                                        <option>Chitwan</option>
                                        <option>Makwanpur</option>
                                        <option>Sankhuwasabha</option>
                                        <option>Terhathum</option>
                                        <option>Dhankuta</option>
                                        <option>Ilam</option>
                                        <option>Panchthar</option>
                                        <option>Taplejung</option>
                                        <option>Morang</option>
                                        <option>Sunsari</option>
                                        <option>Bhojpur</option>
                                        <option>Kapilvastu</option>
                                        <option>Nawalparasi</option>
                                        <option>Rupandehi</option>
                                        <option>Arghakhanchi</option>
                                        <option>Gulmi</option>
                                        <option>Palpa</option>
                                        <option>Baglung</option>
                                        <option>Myagdi</option>
                                        <option>Parbat</option>
                                        <option>Mustang</option>
                                        <option>Dang</option>
                                        <option>Pyuthan</option>
                                        <option>Rolpa</option>
                                        <option>Rukum</option>
                                        <option>Salyan</option>
                                        <option>Dolpa</option>
                                        <option>Humla</option>
                                        <option>Jumla</option>
                                        <option>Kalikot</option>
                                        <option>Mugu</option>
                                        <option>Banke</option>
                                        <option>Bardiya</option>
                                        <option>Surkhet</option>
                                        <option>Dailekh</option>
                                        <option>Jajarkot</option>
                                        <option>Kailali</option>
                                        <option>Achham</option>
                                        <option>Doti</option>
                                        <option>Bajhang</option>
                                        <option>Bajura</option>
                                        <option>Kanchanpur</option>
                                        <option>Dadeldhura</option>
                                        <option>Baitadi</option>
                                        <option>Darchula</option>
                                    </select>           
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*City</label>"; ?>    
                                </td>
                                <td>
                                    <?php echo form_input('city', $this->input->post('city'), 'maxlength="100" class="form-control" placeholder="Enter City" required'); ?>
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*Address</label>"; ?>    
                                </td>
                                <td>
                                    <?php echo form_input('address', $this->input->post('address'), 'maxlength="100" class="form-control" placeholder="Enter Address" required'); ?>
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*Primary Mobile</label>"; ?>    
                                </td>
                                <td>
                                    <input maxlength="100" name="mobile1" type="number" required class="form-control" id="mobile1" placeholder="Enter Primary Mobile" />
                                    <div class="result" id="result3"></div>
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>Secondary Mobile</label>"; ?>    
                                </td>
                                <td>
                                    <input maxlength="100" name="mobile2" type="number" class="form-control" placeholder="Enter Secondary Mobile" />        
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>Landline_no</label>"; ?>    
                                </td>
                                <td>
                                    <input maxlength="100" name="landline_no" type="number" class="form-control" placeholder="Enter Landline No." />        
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" id="checkUser" type="button" >Next</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="setup-content" id="step-2">
                    <div class="form-group">
                        <h3> Step 2&nbsp;&nbsp;(Select category for ad posting)</h3>

                        <div class="category">
                            <?php
                            require_once ('templates/category.php');
                            ?>
                        </div>

                        <div class="search_section">
                            <table>
                                <tr>
                                    <td style="width:30%">
                                        To find best category quick search is here:
                                    </td>

                                    <td style="width:50%">
                                        <input type="text" style="width:40%">
                                        <button>Search</button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Suggested Category:
                                    </td>
                                    <td>
                                        <textarea name="display_cat" id="display_parent" readonly></textarea>
                                        <textarea name="parent_id" id="parent" hidden="hidden" required></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div><!--search_section ends-->

                        <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                    </div>
                </div>

                <div class="setup-content step-3" id="step-3">
                    <div class="form-group">
                        <h3> Step 3</h3>

                        <?php 
                            echo "<strong>*Ad Title:</strong><br>";    
                            echo form_input('ad_title', $this->input->post('ad_title'), 'maxlength="100" class="sstep" placeholder="Title of the product" required'); 
                        ?>
                    
                        <br /><br />

                        <span class="ad_type">
                            <strong>Ad Type:</strong><br />

                            <input type="radio" name="ad_type" id="used" value="Used" checked="checked">Used<br />
                            <input type="radio" name="ad_type" id="likeNew" value="Likely New">Likely New<br />
                           
                        </span>

                        <br><br>

                         <span id="bought_from">
                            <strong>Bought From:</strong><br />
                            
                            <input type="radio" name="bought_from" id="nepal" value="Nepal" checked="checked">Nepal<br />
                            <input type="radio" name="bought_from" id="abroad" value="Abroad">Abroad<br />
                            <input type="text" placeholder="Type Country Name" name="abroad_country" id="country_name">
                        </span>
                        <br><br>

                         <span id="offer">
                            <strong>Offer Price:</strong><br>
                            <input name="offer" type="number" class="sstep"/>

                            <span >
                                <a href="#!"><i class="fa fa-question-circle" id="popup1"></i></a>
                                <a class="popuptext" id="myPopup1" >If it is Service or Advertisement ad leave box blank</a>
                            </span><br/><br/>
                         </span>


                         <span id="used_for">
                            <strong>Used for days/month/year:</strong><br>
                            <input type="number" name="used_for" class="sstep"/>

                             <span id="popup2">
                                 <a href="#!"><i class="fa fa-question-circle"></i></a>
                                 <a class="popuptext" id="myPopup2"> If service related ad (ignore it)</a>
                             </span><br /><br />
                         </span>


                         <span id="market_price">
                             <strong>Market Price:</strong><br>
                             <input type="number" name="market_price"class="sstep" />

                             <a href="#!" id="popup3"><i class="fa fa-question-circle"  ></i></a>
                             <a class="popuptext" id="myPopup3">If you don't know indicative market price leave it blank.</a>
                             <br /><br />
                         </span>


                         <span id="document_no">
                            <strong>(Identification no/Chasis no/Document no/IMEI no):</strong><br>
                             <input type="text" name="document_no" class="sstep"/>

                             <a href="#!" id="popup4"><i class="fa fa-question-circle"  ></i></a>
                             <a class="popuptext" id="myPopup4" >this is optional but if you mention ad id no. your ad is fully verified and trustful and may sold out quickly</a>
                             <br /><br />
                         </span>

                          <strong>Product or Service ad details/ full specification: ( submit with full specification and product details):</strong><br />
                          <input type="text" name="ad_details" id="ad_details" style="width:60%; height:100px;text-align:center" placeholder="TEXT EDITOR" />
                          <div id="textarea_feedback"></div>
                          <br /><br />


                            <strong>Please select your free ad running time</strong>
                                     <select name="ad_running_time">
                                          <option>7 days</option>
                                          <option>15 days</option>
                                          <option>30 days</option>
                                          <option>60 days</option>
                                          <option>90 days</option>
                                    </select><br /><br />

                          <!--   <strong>Own Web site url link:</strong><br>
                                    <input type="text" name="site_url" class="sstep"/>
                                    <a href="#!" id="popup5"><i class="fa fa-question-circle"></i></a>
                                    <a class="popuptext" id="myPopup5">if not leave it blank.</a>
                                    <br /><br /> -->

                            <span id="home_delivery">
                                    <strong>Home delivery facility:</strong><br>
                                    <input type="radio" name="home_delivery" id="yes" value="yes" checked="checked" />Yes<br>
                                    <input type="radio" name="home_delivery" id="no" value="No" />No<br /><br />
                            </span>

                           <div id="delivery_charge">
                                    <strong>Delivery Charges:</strong><br>
                                    <input type="number" name="delivery_charge" class="sstep"/>
                                    <a href="#!" id="popup6"><i class="fa fa-question-circle"  ></i></a>
                                    <a class="popuptext" id="myPopup6">if not leave it blank.</a><br /><br />
                           </div>

                            <span id="warranty">
                                    <strong>Warranty Time:</strong><br>
                                    <input type="number" name="warranty" id="input" class="sstep"/>
                                    <a href="#!" id="popup7"><i class="fa fa-question-circle"></i></a>
                                    <a class="popuptext" id="myPopup7">if not leave it blank.</a><br /><br />
                            </span>

                        <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                    </div>
                </div>

                <div class="setup-content" id="step-4">
                         <div class="form-group">

                            <h3> Step 4</h3>
                            <strong> owner proof document:</strong><br />
                            <input type="checkbox" name="owner_proof[]" noneoption="false" value="Vat/Pan Bill" />Vat/Pan Bill<br />
                            <input type="checkbox" name="owner_proof[]" noneoption="false" value="Product warranty card" />Product warranty card<br />
                            <input type="checkbox" name="owner_proof[]" noneoption="false" value="Product Paking Box" />Product Paking Box<br />
                            <input type="checkbox" name="owner_proof[]" id="none" noneoption="true" value="Not" />Not any above<br /><br />

                            <span id="reason">
                                    <strong>If not any above.<br />specify reason</strong>
                                    <input type="text" name="reason" style="height:30px; width:160px" />
                            </span><br /><br /> 
                        
                            <div id="dynamic_field">
                                <div class="row">
                                    <div class="col-md-10">
                                        <strong>Upload your images here:</strong>
                                        <h5 style="color:blue">First image will be displayed as primary.</h5>
                                        <input type="file" name="upload_images" accept="image/*" onchange="showMyImage(this)" />
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" name="add" id="add" class="btn btn-primary btn-xs pull-right">Add More Photos (Maximum 4)</button>
                                    </div>
                                </div>
                            </div>

<!--                             <input type="file" name="upload_images" multiple />
 -->                            <!-- <input type="file" name="upload_images1" required="required"/>
                            <input type="file" name="upload_images2" required="required"/>
 -->

                            <hr />

                            <strong>Upload Video Url ( From Youtube embedde):<br /><br> Video 1. </strong>
                                    <input type="text" name="video1_url" id="input"/>
                                    <a href="#!" id="popup8"><i class="fa fa-question-circle"  ></i></a>
                                    <a class="popuptext" id="myPopup8">if not leave it blank.</a><br />

                            <strong>Video 2.</strong>
                                    <input type="text" name="video2_url" id="input"/>
                                    <a href="#!" id="popup9"><i class="fa fa-question-circle"  ></i></a>
                                    <a class="popuptext" id="myPopup9">if not leave it blank.</a><br /><br>

                            <input type="submit" class="btn btn-success btn-lg pull-right" value="Done!">
                            <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                            <!-- <button class="btn btn-success btn-lg pull-right" type="submit">Done!</button> -->
                     </div>
                  </div>
            <?php echo form_close(); ?>
        </div><!--end of post_admin-->
    </div><!--col-sm-12-->
</section>
    <!-- <script src="<?php //echo base_url('public'); ?>/js/customValidate.js"></script> -->
            <!-- Base Styling  -->
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/css/app/app.v1.css" />
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/css/app/admin.css" />
    <link rel="stylesheet" href="<?php echo base_url('public'); ?>/css/fileinput.css" />

    <!-- JQuery v1.9.1 -->
	<script src="<?php echo base_url('public'); ?>/js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url('public'); ?>/js/bootstrap/bootstrap.min.js"></script>
    <!-- Custom JQuery -->
	<script src="<?php echo base_url('public'); ?>/js/app/custom.js" type="text/javascript"></script>
    <script src="<?php echo base_url('public'); ?>/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url('public'); ?>/js/hawa.js"></script>
    <script src="<?php echo base_url('public'); ?>/js/categori.js"></script>
    <script src="<?php echo base_url('public'); ?>/js/popup.js"></script>
    <script src="<?php echo base_url('public'); ?>/js/jquery.MultiFile.js"></script>
    
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

            $('#email').keyup(function(){
                var useremail = $(this).val(); // Get username textbox using $(this)
                var Result = $('#result2'); // Get ID of the result DIV where we display the results
                var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                if(reg.test($(this).val())) { // check email format
                    Result.html('Loading...'); // you can use loading animation here
                    var dataPass = 'action=availability&email='+useremail;
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
                if(useremail.length == 0) {
                    Result.html('');
                }
            });

            $('#mobile1').keyup(function(){
                var mobile1 = $(this).val(); // Get primary mobile number of personal textbox using $(this)
                var Result = $('#result3'); // Get ID of the result DIV where we display the results
                if(mobile1.length > 9) { // if greater than 2 (minimum 3)
                    Result.html('Loading...'); // you can use loading animation here
                    var dataPass = 'action=availability&mobile1='+mobile1;
                    $.ajax({ // Send the username val to available.php
                        type : 'POST',
                        data : dataPass,
                        url  : 'available_mobile',
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
                if(mobile1.length == 0) {
                    Result.html('');
                }
            });
        });
    </script>
    
    <script type="text/javascript">    
        function toggle_password(target){
            var d = document;
            var tag = d.getElementById(target);
            var tag2 = d.getElementById("showhide");

            if (tag2.innerHTML == 'Show'){
                tag.setAttribute('type', 'text');   
                tag2.innerHTML = 'Hide';

            } else {
                tag.setAttribute('type', 'password');   
                tag2.innerHTML = 'Show';
            }
        }
    </script>

    <script>
        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#re_password").val();

            if (password != confirmPassword)
                $("#divCheckPasswordMatch").html("Passwords do not match!").css('color','red');
            else
                $("#divCheckPasswordMatch").html("Passwords match.").css('color','green');
        }

        $(document).ready(function () {
            $("#re_password").keyup(checkPasswordMatch);
        });
    </script>
    
    <script>
        $(window).load(function(){
            var i=1;
            $('#add').click(function(){
                //i++;
                if(i<=3) {
                    $('#dynamic_field').append('<div class="row"><div class="col-md-10"><input type="file" name="upload_images'+i+'" accept="image/*"  onchange="showMyImage(this)" /></div></div>');
                    i++;
                }
            });
        });
    </script>

    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            var text_max = 300;
            $('#textarea_feedback').html(text_max + ' characters remaining');

            $('#ad_details').keyup(function() {
                var text_length = $('#ad_details').val().length;
                var text_remaining = text_max - text_length;

                $('#textarea_feedback').html(text_remaining + ' characters remaining');
            });
        });
    </script>
    
	<script>
        $(".category0 li a" || ".category1 li a").on("click", function () {
            var x = $(this).attr('id');
            var y = this.text;
            document.getElementById("parent").innerHTML = x;
            document.getElementById("display_parent").innerHTML = y;
            $("#display_parent").css('color','black');
        });
    </script>

</body>
</html>
