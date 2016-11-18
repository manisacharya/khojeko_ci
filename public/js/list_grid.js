// JavaScript Document
	
	 
$(document).ready(function () {  
	var elem=$('ul.list');     

	$('#viewcontrols a').on('click',function(e) {

	 if ($(this).hasClass('gridview')) {

	  elem.fadeOut(1000, function () {

	  elem.removeClass('list').addClass('grid');

	  elem.fadeIn(1000);

	         });     

	 }

	 else if($(this).hasClass('listview')) {

	  elem.fadeOut(1000, function () {

	  elem.removeClass('grid').addClass('list');

	  elem.fadeIn(1000);

	        });        

	 }

	});

	});