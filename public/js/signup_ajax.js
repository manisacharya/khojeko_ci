$(document).ready(function(){
    $('#txtNewPassword').keyup(function(){ $('#error1').hide(); });
    $('#termsandcondition').click(function(){ $('#error2').hide(); });
    $('#full_name').click(function(){ $('#perror1').hide(); });
    $('#zone_p').click(function(){ $('#perror2').hide(); });
    $('#district_p').click(function(){ $('#perror3').hide(); });
    $('#city_p').click(function(){ $('#perror4').hide(); });
    $('#address_p').click(function(){ $('#perror5').hide(); });
    $('#dealer_name').click(function(){ $('#derror1').hide(); });
    $('#zone').click(function(){ $('#derror2').hide(); });
    $('#district').click(function(){ $('#derror3').hide(); });
    $('#city').click(function(){ $('#derror4').hide(); });
    $('#address').click(function(){ $('#derror5').hide(); });
    $('#profile').click(function(){ $('#derror6').hide(); });
    $('#dealerlogo').click(function(){ $('#derror7').hide(); });
    $('#dealervat').click(function(){ $('#derror8').hide(); });
    $('#dealerstore').click(function(){ $('#derror9').hide(); });

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

    var e = document.getElementById("district_p");
    var district_selected = e.options[e.selectedIndex].value;
    var e = document.getElementById("zone_p");
    var strUser = e.options[e.selectedIndex].value;
    var dataPass = 'action=availability&zone=' + strUser + '&district_selected=' + district_selected;
    $.ajax({
        type: 'POST',
        data: dataPass,
        url: 'get_districts',
        success: function(html){
            $("#district_p").html("");
            $("#district_p").html(html);
        }
    });
    $('#zone_p').change(function(){
        var zone = $(this).val();
        var dataPass = 'action=availability&zone=' + zone + '&district_selected=l';
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

    var e = document.getElementById("district");
    var district_selected = e.options[e.selectedIndex].value;
    var e = document.getElementById("zone");
    var strUser = e.options[e.selectedIndex].value;
    var dataPass = 'action=availability&zone=' + strUser + '&district_selected=' + district_selected;
    $.ajax({
        type: 'POST',
        data: dataPass,
        url: 'get_districts',
        success: function(html){
            $("#district").html("");
            $("#district").html(html);
        }
    });
    $('#zone').change(function(){
        var zone = $(this).val();
        var dataPass = 'action=availability&zone=' + zone + '&district_selected=l';
        $.ajax({
            type: 'POST',
            data: dataPass,
            url: 'get_districts',
            success: function(html){
                $("#district").html("");
                $("#district").html(html);
            }
        });
    });
});