$(document).ready(function(){
    $(".category1").hide();
    $(".category2").hide();
    $(".category3").hide();
    $(".glyphicon-minus-sign").hide();
    $(".category3 li a").find('span').hide('glyphicon-plus-sign glyphicon-minus-sign');
    $(".category0 li a").click(function(){
        $(this).next(".category1").slideToggle();
        $(this).find('span').toggleClass('glyphicon-plus-sign glyphicon-minus-sign');
        return false;
    })
     $(".category1 li a").click(function(){
        $(this).next(".category2").slideToggle();
        return false;
    })
    $(".category2 li a").click(function(){
        $(this).next(".category3").slideToggle();
        /*$("#content").load("page2.php");
         $("#guts").hide();*/
        return false;
    })
})

$("button.parent_click").on("click", function () {
    document.getElementById("display_parent").innerHTML = 'Set as parent';
    document.getElementById("parent").innerHTML = 0;
    $("#display_parent").css('color','green');
})

$(".cname li a").on("click", function () {
    var x = this.text;
    var y = $(this).attr('id');
    document.getElementById("display_cname").innerHTML = x;
    document.getElementById("c_id").innerHTML = y;
    $("#display_cname").css('color','black');
})

$(".parent li a").on("click", function () {
    var x = this.text;
    var y = $(this).attr('id');
    document.getElementById("display_parent").innerHTML = x;
    document.getElementById("parent").innerHTML = y;
    $("#display_parent").css('color','black');
})

$(".post-ad-category li a").on("click", function () {
    var x = this.text;
    var y = $(this).attr('id');
    document.getElementById("post_cname").innerHTML = x;
    document.getElementById("post_c_slug").innerHTML = y;
    $("#post_cname").css('color','black');
})

$(".parent .category3 li a").on("click", function () {
    document.getElementById("display_parent").innerHTML = 'You cannot choose Parent Category';
    document.getElementById("parent").innerHTML = '';
    $("#display_parent").css('color','red');
})
