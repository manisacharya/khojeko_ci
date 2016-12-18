
//show image for choose file
function showMyImage(input,id,num) {
    $('#thumbnail'+num).removeAttr('src').removeAttr('style');
    $('#btn'+num).remove();
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //var img_id = 'thumbnail'+num;
            $('#thumbnail'+num)
                .attr('src', e.target.result)
                .width(100)
                .height(100);
        };
        reader.readAsDataURL(input.files[0]);
        createCloseButton(num,id);
    }
}

//create close button with image shown
function createCloseButton(i,input_id) {
    $('#'+input_id).hide();
    var btn = document.createElement("BUTTON");
    btn.setAttribute("onclick", "remove('btn"+i+"')");
    btn.setAttribute("id", "btn"+i);
    btn.setAttribute("type", "button");
    btn.setAttribute("name", i+":"+input_id);
    btn.setAttribute("class", "btn btn-danger btn-xs btn_remove");
    var t = document.createTextNode("X");
    btn.appendChild(t);
    document.getElementById("row"+i).appendChild(btn);
}

//remove image and button after clodse button clicked
function remove(button_id) {
    var id = document.getElementById(button_id).getAttribute("name").split(":");

    $('#thumbnail'+id[0]).removeAttr('src').removeAttr('style');
    $('#'+button_id).remove();
    $('#'+id[1]).show();
    return document.getElementById(id[1]).value = '';
}

//check input required attribute with next button click in step 1
function checkRequired() {
    $('#alert1').remove();
    $('#alert2').remove();
    $('#alert3').remove();
    $('#alert4').remove();
    $('#alert5').remove();
    var inputObj1 = document.getElementById("useremail");
    var inputObj2 = document.getElementById("txtNewPassword");
    var inputObj3 = document.getElementById("txtConfirmPassword");
    var inputObj4 = document.getElementById("termsandcondition");
    var inputObj5 = document.getElementById("username");

    if (inputObj1.checkValidity() == false) { createDiv(inputObj1, 'result2', 'alert1'); }
    if (inputObj2.checkValidity() == false) { $('#error1').show(); createDiv(inputObj2, 'error1', 'alert2'); }
    if (inputObj3.checkValidity() == false) { createDiv(inputObj3, 'divCheckPasswordMatch', 'alert3'); }
    if (inputObj4.checkValidity() == false) { $('#error2').show(); createDiv(inputObj4, 'error2', 'alert4'); }
    if (inputObj5.checkValidity() == false) { createDiv(inputObj5, 'result1', 'alert5'); }
}

//check input required attribute with next button click in step 1
function checkSubmit() {
    //for personal div
    $('#alert6').remove();  $('#alert7').remove();  $('#alert8').remove();
    $('#alert9').remove();  $('#alert10').remove(); $('#alert11').remove();
    var inputObj6 = document.getElementById("full_name");
    var inputObj7 = document.getElementById("zone_p");
    var inputObj8 = document.getElementById("district_p");
    var inputObj9 = document.getElementById("city_p");
    var inputObj10 = document.getElementById("address_p");
    var inputObj11 = document.getElementById("mobile_p");

    if (inputObj6.checkValidity() == false) { $('#perror1').show(); createDiv(inputObj6, 'perror1', 'alert6'); }
    if (inputObj7.checkValidity() == false) { $('#perror2').show(); createDiv(inputObj7, 'perror2', 'alert7'); }
    if (inputObj8.checkValidity() == false) { $('#perror3').show(); createDiv(inputObj8, 'perror3', 'alert8'); }
    if (inputObj9.checkValidity() == false) { $('#perror4').show(); createDiv(inputObj9, 'perror4', 'alert9'); }
    if (inputObj10.checkValidity() == false) { $('#perror5').show(); createDiv(inputObj10, 'perror5', 'alert10'); }
    if (inputObj11.checkValidity() == false) { createDiv(inputObj11, 'result3', 'alert11'); }

    //for dealer div
    $('#alert12').remove();  $('#alert13').remove();  $('#alert14').remove();
    $('#alert15').remove();  $('#alert16').remove(); $('#alert17').remove();
    $('#alert18').remove();  $('#alert19').remove(); $('#alert20').remove(); $('#alert21').remove();
    var inputObj12 = document.getElementById("dealer_name");
    var inputObj13 = document.getElementById("zone");
    var inputObj14 = document.getElementById("district");
    var inputObj15 = document.getElementById("city");
    var inputObj16 = document.getElementById("address");
    var inputObj17 = document.getElementById("mobile_d");
    var inputObj18 = document.getElementById("profile");
    var inputObj19 = document.getElementById("dealerlogo");
    var inputObj20 = document.getElementById("dealervat");
    var inputObj21 = document.getElementById("dealerstore");

    if (inputObj12.checkValidity() == false) { $('#derror1').show(); createDiv(inputObj12, 'derror1', 'alert12'); }
    if (inputObj13.checkValidity() == false) { $('#derror2').show(); createDiv(inputObj13, 'derror2', 'alert13'); }
    if (inputObj14.checkValidity() == false) { $('#derror3').show(); createDiv(inputObj14, 'derror3', 'alert14'); }
    if (inputObj15.checkValidity() == false) { $('#derror4').show(); createDiv(inputObj15, 'derror4', 'alert15'); }
    if (inputObj16.checkValidity() == false) { $('#derror5').show(); createDiv(inputObj16, 'derror5', 'alert16'); }
    if (inputObj17.checkValidity() == false) { createDiv(inputObj17, 'result4', 'alert17'); }
    if (inputObj18.checkValidity() == false) { $('#derror6').show(); createDiv(inputObj18, 'derror6', 'alert18'); }
    if (inputObj19.checkValidity() == false) { $('#derror7').show(); createDiv(inputObj19, 'derror7', 'alert19'); }
    if (inputObj20.checkValidity() == false) { $('#derror8').show(); createDiv(inputObj20, 'derror8', 'alert20'); }
    if (inputObj21.checkValidity() == false) { $('#derror9').show(); createDiv(inputObj21, 'derror9', 'alert21'); }
}

//create div for error in input required attribute with next button click in step 1
function createDiv(inpObj,div_id,alert_id) {
    var div = document.createElement("div");
    div.setAttribute("class", "alert alert-danger");
    div.setAttribute("id", alert_id);
    var t = document.createTextNode(inpObj.validationMessage);
    div.appendChild(t);
    document.getElementById(div_id).appendChild(div);
}