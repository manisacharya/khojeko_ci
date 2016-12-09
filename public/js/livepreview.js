
    function showMyImage1(input) {
        if(document.getElementById("dealerlogo").value.length == 0) {
            $('#thumbnail1').removeAttr('src').removeAttr('style');
            $('#btn1').remove();
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#thumbnail1')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
            myFunction('1','dealerlogo');
        }
    }

    function showMyImage2(input) {
        if(document.getElementById("dealervat").value.length == 0) {
            $('#thumbnail2').removeAttr('src').removeAttr('style');
            $('#btn2').remove();
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#thumbnail2')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
            myFunction('2','dealervat');
        }
    }

    function showMyImage3(input) {
        if(document.getElementById("dealerstore").value.length == 0) {
            $('#thumbnail3').removeAttr('src').removeAttr('style');
            $('#btn3').remove();
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#thumbnail3')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
                $('#3')
                    .attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
            myFunction('3','dealerstore');
        }
    }

    function showMyImage4(input) {
        if(document.getElementById("dealerstore1").value.length == 0) {
            $('#thumbnail4').removeAttr('src').removeAttr('style');
            $('#btn4').remove();
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#thumbnail4')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
            myFunction('4', 'dealerstore1');
        }

    }

    function showMyImage5(input) {
        if(document.getElementById("dealerstore2").value.length == 0) {
            $('#thumbnail5').removeAttr('src').removeAttr('style');
            $('#btn5').remove();
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#thumbnail5')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
            myFunction('5','dealerstore2');
        }
    }

    function showMyImage6(input) {
        if(document.getElementById("dealerstore3").value.length == 0) {
            $('#thumbnail6').removeAttr('src').removeAttr('style');
            $('#btn5').remove();
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();
                reader.onload = function (e) {gi
                        $('#thumbnail6')
                            .attr('src', e.target.result)
                            .width(100)
                            .height(100);
                };
            reader.readAsDataURL(input.files[0]);
            myFunction('6','dealerstore3');
        }
    }

    function myFunction(i,input_id) {
        var btn = document.createElement("BUTTON");
        btn.setAttribute("id", "btn"+i);
        btn.setAttribute("type", "button");
        btn.setAttribute("name", i+":"+input_id);
        btn.setAttribute("class", "btn btn-danger btn-xs btn_remove");
        var t = document.createTextNode("X");
        btn.appendChild(t);
        document.getElementById("row"+i).appendChild(btn);
    }

    $(window).load(function(){
        var i=1;
        $('#dynamic_field').on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            var id = $(this).attr("name").split(":");

            $('#thumbnail'+id[0]).removeAttr('src').removeAttr('style');
            $('#'+button_id).remove();
            return document.getElementById(id[1]).value = '';
        });
    });