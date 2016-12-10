$(document).ready(function(){
	$(".category1").hide();
	$(".category2").hide();
	$(".category3").hide();
	$(".glyphicon-minus").hide();
    $(".category0 li a").click(function(){
        $(this).next(".category1").slideToggle();
		$(this).find('span').toggleClass('glyphicon-plus glyphicon-minus');
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

