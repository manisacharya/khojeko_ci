
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
            myFunction(num,id);
        }
    }

    function myFunction(i,input_id) {
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

    //$(window).load(function(){
        //$('#dynamic_field').on('click', '.btn_remove', function() {
    function remove(input) {
        var button_id = input;
        var id = document.getElementById(input).getAttribute("name").split(":");

        $('#thumbnail'+id[0]).removeAttr('src').removeAttr('style');
        $('#'+button_id).remove();
        return document.getElementById(id[1]).value = '';
    }

        //})
    //});