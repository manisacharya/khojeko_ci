function sub_category_items(c_slug) {

    var dataPass = 'action=availability&slug=' + c_slug;
    $.ajax({
        type: 'POST',
        data: dataPass,
        url: 'get_sub_categories_and_items',
        dataType:"json", //to parse string into JSON object,
        success: function(data){
            if(data){
                var c_array = data['sub_categories_list'];
                var total_sub_categories = c_array.length;

                var items_array = data['sub_categories_items'];
                var total_sub_categories_items = items_array.length;

                var main_content = '';
                var content_header =
                                '<div id="content">' +
                                    '<div class="category_display">' +
                                        '<h4>'+data['category_title']+'</h4>' +
                                        '<div class="subcategory_display">' +
                                            '<ul class="nav nav-pills nav-justified">';
                var category_content = '';

                var category_footer =        '</ul>' +
                                        '</div>' +
                                    '</div>';

                var items_content = '';

                if (total_sub_categories > 0) {
                    for(var i=0; i<total_sub_categories; i++) {
                        category_content += '<li><a onclick="sub_category_items(\''+c_array[i].c_slug+'\')">'+c_array[i].c_name+'</a></li>';
                    }
                }
                else {
                        category_content =  '<div class="no-child">No Sub Categories</div>';
                }
                main_content = content_header+category_content+category_footer;


                var items_header =  '<div class="listCon">'+
                                        '<div id="viewcontrols" data-enhance="false">' +
                                            '<a class="info">'+data['category_title']+'&nbsp;Items</a>' +
                                        '</div>' +
                                        '<ul class="list">';
                var content_footer =    '</ul>' +
                                    '</div>'+
                                '</div>';

                if (total_sub_categories_items > 0) {
                    for(var j=0; j<total_sub_categories_items; j++) {
                        items_content +=    '<li>' +
                                                '<div class="col-sm-2" id="image_content">' +
                                                    '<img src="public/images/item_images/'+items_array[j].image+'" class="img-responsive"/>' +
                                                '</div>' +
                                                '<div class="col-sm-10" id="info_content">' +
                                                    '<section class="list-right">' +
                                                        '<span class="price">' +
                                                            '<a class="button">'+items_array[j].category+'</a><br>' +
                                                            '<a data-toggle="tooltip" data-placement="bottom" title="'+items_array[j].views+'"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;' +
                                                            '<span class="glyphicon glyphicon-time"></span>&nbsp;' +
                                                            '<span class="glyphicon glyphicon-heart"></span>&nbsp;' +
                                                            '<a data-toggle="tooltip" data-placement="bottom" title="'+items_array[j].comment_count+'"><span class="glyphicon glyphicon-comment"></span></a>' +
                                                        '</span>' +
                                                    '</section>' +
                                                    '<section class="list-left">' +
                                                        '<span class="title">' +
                                                        '<b>Rs '+items_array[j].price+'<font color="red">&nbsp;('+items_array[j].item_type+')</font></b><br>' +
                                                        '<a class="sub" href="">'+items_array[j].title+'</a><br>' +
                                                        '<span class="address">' +
                                                            '<span>'+items_array[j].avaibility_address+'</span>&nbsp;<span>2072/12/25</span>' +
                                                        '</span>' +
                                                        '<p>'+items_array[j].specs+'</p>' +
                                                    '</section>' +
                                                '</div>' +
                                            '</li>';
                    }
                }

                else {
                    items_content =  '<div class="no-child">No Items</div>';
                }
                main_content += items_header+items_content+content_footer;
                $('#content').replaceWith(main_content);
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
