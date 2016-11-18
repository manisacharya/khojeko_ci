// JavaScript Document
$(document).ready(function(){
	$(".category1").hide();
	$(".category2").hide();
	$(".category3").hide();
	$(".minus0").hide();
    $(".category0 li a").click(function(){
        $(this).next(".category1").slideToggle();
		$(this).find('i').toggleClass('fa-plus-circle fa-minus-circle');
	
		return false;
    })
    $(".category1 li a").click(function(){
        $(this).next(".category2").slideToggle();
	;
		return false;
    })
	$(".category2 li a").click(function(){
		$(this).next(".category3").slideToggle();
		;
		return false;
	})
	  
})

