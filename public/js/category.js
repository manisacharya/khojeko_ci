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

$("ul.category li a").click(function() {
    document.getElementById("category_filter").value = $(this).attr('id');
});
