$(document).ready(function(){
	$(".category1").hide();
	$(".category2").hide();
	$(".category3").hide();
	$(".glyphicon-minus-sign").hide();
    $(".category0 li a").click(function(){
        $(this).next(".category1").slideToggle();
		$(this).find('span').toggleClass('glyphicon-plus-sign glyphicon-minus-sign');
		/*$("#content").load("page.php");
		$("#guts").hide();*/
		return false;
    })
     $(".category1 li a").click(function(){
        $(this).next(".category2").slideToggle();
		/*$("#content").load("page1.php");
		$("#guts").hide();*/
		return false;
    })
	$(".category2 li a").click(function(){
		$(this).next(".category3").slideToggle();
		/*$("#content").load("page2.php");
		 $("#guts").hide();*/
		return false;
	})
})

$(".parent_click a").on("click", function () {
    document.getElementById("display_parent").innerHTML = 'Set as parent';
    document.getElementById("parent").innerHTML = 0;
    $("#display_parent").css('color','green');
})

$(".cname .category0 li a" || ".cname .category1 li a").on("click", function () {
    var x = this.text;
    var y = $(this).attr('id');
    document.getElementById("display_cname").innerHTML = x;
    document.getElementById("c_id").innerHTML = y;
    $("#display_cname").css('color','black');
})

$(".parent .category0 li a" || ".parent .category1 li a").on("click", function () {
    var x = this.text;
    var y = $(this).attr('id');
    document.getElementById("display_parent").innerHTML = x;
    document.getElementById("parent").innerHTML = y;
    $("#display_parent").css('color','black');
})

$(".parent .category3 li a").on("click", function () {
    document.getElementById("display_parent").innerHTML = 'you cannot choose this as parent category';

    $("#display_parent").css('color','red');
})
