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
                var header = '<div id="content"><div class="category_display"><h4>Sub Category</h4><div class="subcategory_display" id="category1_display">';
                var content = '';
                var footer = '</div></div></div>';
                if(len > 0){
                    for(var i=0; i<len; i++){
                        content += '<div class="childs"><div class="heading">'+data['sub_categories_list'][i].c_name+'</div></div>';
                    }
                    if(content != ""){
                        $('#content').replaceWith(header+content+footer);
                    }
                }
                else {
                    content += '<div class="childs"><div class="heading">No Sub Categories</div></div>'
                    $('#content').replaceWith(header+content+footer);
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#error_content').replaceWith('<div id="error_content"><div class="alert alert-danger alert-dismissable fade in">Something went wrong. Please try again in a moment.' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button></div></div>');
        }
    });
}
