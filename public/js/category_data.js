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
                                        '<div class="subcategory_display">' +
                                            '<ul class="nav nav-pills nav-justified">';
                var category_content = '';
                var category_footer =        '</ul>' +
                                        '</div>' +
                                    '</div>';
                var items_header =  '<div class="listCon">'+
                                        '<div id="viewcontrols" data-enhance="false">' +
                                            '<a class="info">'+data['category_title']+'&nbspItems</a>' +
                                        '</div>' +
                                        '<ul class="list">';
                var items_content = '';
                items_content +=            '<li>' +
                                                '<div class="col-sm-2" id="image_content">' +
                                                    '<img src="images/nokia lumia.jpg" class="img-responsive"/>' +
                                                '</div>' +
                                                '<div class="col-sm-10" id="info_content">' +
                                                    '<section class="list-right">' +
                                                        '<span class="price">' +
                                                            '<a class="button">mobile>>nokia</a><br>' +
                                                            '<i class="fa fa-eye" ></i>' +
                                                            '<i class="fa fa-clock-o" ></i>' +
                                                            '<i class="fa fa-heart" ></i>' +
                                                            '<i class="fa fa-comment-o"></i>' +
                                                        '</span>' +
                                                    '</section>' +
                                                    '<section class="list-left">' +
                                                        '<span class="title">' +
                                                        '<b>Rs 12300<font color="red">&nbsp;(new)</font></b><br>' +
                                                        '<a class="sub" href="!#">Nokia lumia</a><br>' +
                                                        '<span class="name">' +
                                                            '<i class="fa fa-check-circle" id="tick"></i><b>&nbsp;Ad by:Bishnu Limbu,</b>' +
                                                        '</span>' +
                                                        '<span class="address">' +
                                                            '<span>	Kathmandu,Nepal,</span><span>2072/12/25</span>' +
                                                        '</span>' +
                                                        '<p> Product description goes here. Aliquam tincidunt diam varius ultricies auctor. Vivamus faucibus risus tempus, adipiscing justo </p>' +
                                                    '</section>' +
                                                '</div>' +
                                            '</li>';
                var items_footer =      '</ul>' +
                                    '</div>';
                var content_footer =
                                '</div>';
                if (len > 0) {
                    for(var i=0; i<len; i++) {
                        category_content += '<li><a onclick="sub_category_items(\''+data['sub_categories_list'][i].c_slug+'\')">'+data['sub_categories_list'][i].c_name+'</a></li>';
                    }
                    if (category_content != "") {
                        $('#content').replaceWith(content_header+category_content+category_footer+items_header+items_content+items_footer+content_footer);
                    }
                }
                else {
                    category_content +=  '<div class="no-child">No Sub Categories</div>';
                    $('#content').replaceWith(content_header+category_content+content_footer);
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
