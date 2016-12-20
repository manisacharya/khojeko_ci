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
                var content_header =
                                '<div id="content">' +
                                    '<div class="category_display">' +
                                        '<h4>'+data['category_title']+'</h4>' +
                                        '<div class="subcategory_display" id="category1_display">';
                var category_content = '';
                var items_content =     '</div>' +
                                    '</div>';
                var content_footer =
                                '</div>';
                if(len > 0){
                    for(var i=0; i<len; i++){
                        category_content += '<div class="childs">' +
                                        '<div class="heading">'+data['sub_categories_list'][i].c_name+'</div>' +
                                    '</div>';
                    }
                    if(content != ""){
                        $('#content').replaceWith(content_header+category_content+items_content+content_footer);
                    }
                }
                else {
                    content +=  '<div class="childs">' +
                                    '<div class="heading">No Sub Categories</div>' +
                                '</div>'
                    $('#content').replaceWith(content_header+category_content+items_content+content_footer);
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            var html =  '<div id="error_content">' +
                            '<div class="alert alert-danger alert-dismissable fade in">Something went wrong. Please try again in a moment.' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                    '<span class="glyphicon glyphicon-remove"></span>' +
                                '</button>' +
                            '</div>' +
                        '</div>';
            $('#error_content').replaceWith(html);
        }
    });
}
