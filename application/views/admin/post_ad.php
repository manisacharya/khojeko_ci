<?php
   //echo $this->session->flashdata('message');
   //echo $this->session->flashdata('error');
echo $message;
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

                            <tr>
                                <td>
                                    <?php echo "<label class='control-label' name='email_check'>*Email</label>"; ?>    
                                </td>
                                <td>
                                    <?php echo form_input('email', $this->input->post('email'), 'maxlength=100 class="form-control" id="email" placeholder="Enter Email" autofocus required'); ?>
                                    <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
                                    <div class="result" id="result2"></div>
                                </td>
                            </tr>

                             <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*Ad Owner Name</label>"; ?>    
                                </td>
                                <td>
                                    <?php echo form_input('owner_name', $this->input->post('owner_name'), 'maxlength=100 class="form-control" placeholder="Enter Owner Name" required'); ?>
                                    <?php echo form_error('owner_name', '<div class="alert alert-danger">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*User Name</label>"; ?>    
                                </td>
                                <td>
                                    <?php echo form_input('username', $this->input->post('username'), 'maxlength=100 class="form-control" id="username" placeholder="Enter User Name" required'); ?>
                                    <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); ?>
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
                                    echo form_error('password', '<div class="alert alert-danger">', '</div>'); 
                                    // echo form_input('password', $this->input->post('password'), 'maxlength="100" class="form-control" id="password" placeholder="Password" type="password" required'); ?>
                                    <a onclick="toggle_password('password');" id="showhide">Show</a>
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
                                    echo form_error('re_password', '<div class="alert alert-danger">', '</div>'); ?>
                                    <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>

                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*Zone</label>"; ?>    
                                </td>
                                <td>
                                    <?php
                                        $options = array();
                                        $options[] = "--Select Zone--";

                                        foreach($zones as $row) {
                                            $options[$row->zone_name] = $row->zone_name;
                                        }
                                        echo form_dropdown('zone', $options, $this->input->post('zone'), ' id="zone"');
                                    ?>

                                    <?php echo form_error('zone', '<div class="alert alert-danger">', '</div>'); ?>                
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*District</label>"; ?>    
                                </td>
                                <td>
                                    <select name='district' id='district'>
                                        <option value="">-- Select District --</option>
                                    </select>
                
                                    <?php echo form_error('district', '<div class="alert alert-danger">', '</div>'); ?>     
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*City</label>"; ?>    
                                </td>
                                <td>
                                    <?php echo form_input('city', $this->input->post('city'), 'maxlength=100 class="form-control" placeholder="Enter City" required'); ?>
                                    <?php echo form_error('city', '<div class="alert alert-danger">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*Address</label>"; ?>    
                                </td>
                                <td>
                                    <?php echo form_input('address', $this->input->post('address'), 'maxlength=100 class="form-control" placeholder="Enter Address" required'); ?>
                                    <?php echo form_error('address', '<div class="alert alert-danger">', '</div>'); ?>
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>*Primary Mobile</label>"; ?>    
                                </td>
                                <td>
                                    <input maxlength=10 name="mobile1" type="number" required class="form-control" id="mobile1" placeholder="Enter Primary Mobile" maxlength = 10/>
                                    <?php echo form_error('mobile1', '<div class="alert alert-danger">', '</div>'); ?>
                                    <div class="result" id="result3"></div>
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>Secondary Mobile</label>"; ?>    
                                </td>
                                <td>
                                    <input maxlength=10 name="mobile2" id="mobile2" type="number" class="form-control" placeholder="Enter Secondary Mobile" maxlength = 10/>
                                    <?php echo form_error('mobile2', '<div class="alert alert-danger">', '</div>'); ?>       
                                    <div class="result" id="sec_result"></div>
                                </td>
                            </tr>

                            <tr class="tr_hide">
                                <td>
                                    <?php echo "<label class='control-label'>Landline_no</label>"; ?>    
                                </td>
                                <td>
                                    <input maxlength=10 name="landline_no" id="landline_no" type="number" class="form-control" maxlength = 9 placeholder="Enter Landline No."/>
                                    <?php echo form_error('landline_no', '<div class="alert alert-danger">', '</div>'); ?>  
                                    <div class="result" id="tel_p_result"></div>
   
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
                            require_once('templates/category.php');
                            print_list(0, 0, $categories, 'front/');
                            //require_once('/../admin/templates/category.php');
                            ?>
                        </div>

                        <div class="search_section">
                            <table>
                                
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
                          <input type="text" name="ad_details" id="ad_details" style="width:60%; height:100px;text-align:center" maxlength = 300 placeholder="TEXT EDITOR" />
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

                <!-- <div class="setup-content step-5">
                    <div class="form-group">
                        <div class="message">
                            <a id="success-message">Congratulation your account is successfully created.</a>
                            <a id="unsuccess-message">Please check your email and verify your account soon.</a>
                        </div>
                    </div>
                </div> -->

            <?php echo form_close(); ?>
        </div><!--end of post_admin-->
    </div><!--col-sm-12-->
</section>
    