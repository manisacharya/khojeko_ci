function sub_category_items(c_slug) {

    var dataPass = 'action=availability&slug=' + c_slug;
    $.ajax({
        type: 'POST',
        data: dataPass,
        url: 'get_sub_categories_and_items',
        dataType:"json", //to parse string into JSON object,
        success: function(data){
            if(data){
                var len = data['sub_categories_list'].length;
                var txt = "<div id='content'><ul>";
                if(len > 0){
                    for(var i=0;i<len;i++){
                        txt += "<li>"+data['sub_categories_list'][i].c_name+"</li>";
                    }
                    txt += "</ul></div>"
                    if(txt != ""){
                        $("#content").replaceWith(txt);
                    }
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('error: ' + textStatus + ': ' + errorThrown);
        }
    });
}
