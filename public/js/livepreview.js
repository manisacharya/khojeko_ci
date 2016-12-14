
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
        alert('abc');
        $('.alert').remove();
        var inputObj1 = document.getElementById("useremail");
        var inputObj2 = document.getElementById("txtNewPassword");
        var inputObj3 = document.getElementById("txtConfirmPassword");
        var inputObj4 = document.getElementById("termsandcondition");

        if (inputObj1.checkValidity() == false) { createDiv(inputObj1, 'result2'); }
        /*if (inputObj2.checkValidity() == false) {
            $('#error1').show();
            createDiv(inputObj2, 'error1');
        }
        if (inputObj3.checkValidity() == false) { createDiv(inputObj3, 'divCheckPasswordMatch'); }
        if (inputObj4.checkValidity() == false) {
            $('#error2').show();
            createDiv(inputObj4, 'error2');
        }*/
    }

    //create div for error in input required attribute with next button click in step 1
    function createDiv(inpObj,div_id) {
        var div = document.createElement("div");
        div.setAttribute("class", "alert alert-danger");
        var t = document.createTextNode(inpObj.validationMessage);
        div.appendChild(t);
        document.getElementById(div_id).appendChild(div);
    }