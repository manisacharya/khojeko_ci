
<!-- JQuery v1.9.1 -->
<script src="<?php echo base_url('public'); ?>/js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('public'); ?>/js/jquery.MultiFile.js"></script>
<script src="<?php echo base_url('public'); ?>/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>

<script src="<?php echo base_url('public'); ?>/js/bootstrap/bootstrap.min.js"></script>
<!-- Custom JQuery -->
<script src="<?php echo base_url('public'); ?>/js/app/custom.js" type="text/javascript"></script>
<script src="<?php echo base_url('public'); ?>/js/preview.js"></script>
<script src="<?php echo base_url('public'); ?>/js/hawa.js"></script>
<script src="<?php echo base_url('public'); ?>/js/category.js"></script>
<script src="<?php echo base_url('public'); ?>/js/popup.js"></script>
    
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

        $('#zone').change(function(){
            var zone = $(this).val();
            var dataPass = 'action=availability&zone=' + zone;
            $.ajax({ // Send the username val to available.php
                type: 'POST',
                data: dataPass,
                url: 'get_district',
                success: function(html){
                    $("#district").html("");
                    $("#district").html(html);
                }
            });
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

        $('#mobile2').keyup(function(){
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

        $('#landline_no').keyup(function(){
            var telephone_p = $(this).val(); // Get primary mobile number of personal textbox using $(this)
            var Result = $('#tel_p_result'); // Get ID of the result DIV where we display the results
            var reg = /^([0-9])+$/;
            if((reg.test($(this).val()))) { // check number format
                if(telephone_p.length < 9) { // if greater than 9 (minimum 10)
                    Result.html('Telephone number must have 9 digits').css('color','#ff5500');
                } else {
                    Result.html('<span class="success">This telephone number can be used</span>').css('color', 'green');
                }
            }else{
                Result.html('Please enter only numbers').css('color','red');
            }
        });
    });
</script>

<!-- for toggling show/hide option on password -->
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

<!-- for password match check -->
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

<!-- for dynamic addition of image tag -->
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

<!-- for characters limiting and showing charcters remaining in text box -->
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

<!-- for adding category list name and id -->
<script>
    $(".parent_click a").on("click", function () {
        document.getElementById("display_parent").innerHTML = 'Set as parent';
        document.getElementById("parent").innerHTML = 0;
        $("#display_parent").css('color','green');
    })

    $(".cname .category0 li a" || ".cname .category1 li a").on("click", function () {
        var x = this.text;
        var y = $(this).attr('id');
        document.getElementById("display_cname").innerHTML = x;
        document.getElementById("c_id").innerHTML = y;
        $("#display_cname").css('color','black');
    })

    $(".parent .category0 li a" || ".parent .category1 li a").on("click", function () {
        var x = this.text;
        var y = $(this).attr('id');
        document.getElementById("display_parent").innerHTML = x;
        document.getElementById("parent").innerHTML = y;
        $("#display_parent").css('color','black');
    })

    $(".parent .category3 li a").on("click", function () {
        document.getElementById("display_parent").innerHTML = 'you cannot choose this as parent category';

        $("#display_parent").css('color','red');	})
</script>

<script>
    $("#hide").on("click", function () {
        $(".statics").hide();

    })
    $("#show").on("click", function () {
        $(".statics").show();

    })
</script>

<script>
    function toggle1(source) {
        checkboxes = document.getElementsByName('foo1[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function toggle2(source) {
        checkboxes = document.getElementsByName('foo2[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>

<style type="text/css">
    .category3 i {
        display: none;
    }
</style>

<!--<script type="text/javascript">
    $(document).ready(function() {
        $("#select").searchable();
    });
</script>-->

<script>
    $(document).bind("mobileinit", function() {
        $.mobile.ignoreContentEnabled = true;
    });
</script>





</body>
</html>
