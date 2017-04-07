// JavaScript Document

// When the user clicks on div, open the popup


$(document).ready(function(){
	    $('#myPopup1').hide();

$('#popup1').click(function() {
    $('#myPopup1').slideToggle();
});
});

$(document).ready(function(){
	$('#myPopup2').hide();
$('#popup2').click(function() {
    $('#myPopup2').slideToggle();
});
});

$(document).ready(function(){
	$('#myPopup3').hide();
$('#popup3').click(function() {
    $('#myPopup3').slideToggle();
});
});

$(document).ready(function(){
	$('#myPopup4').hide();
$('#popup4').click(function() {
    $('#myPopup4').slideToggle();
});
});

$(document).ready(function(){
	$('#myPopup5').hide();
$('#popup5').click(function() {
    $('#myPopup5').slideToggle();
});
});

$(document).ready(function(){
	$('#myPopup6').hide();
$('#popup6').click(function() {
    $('#myPopup6').slideToggle();
});
});


$(document).ready(function(){
	$('#myPopup7').hide();
$('#popup7').click(function() {
    $('#myPopup7').slideToggle();
});
});

$(document).ready(function(){
	$('#myPopup8').hide();
$('#popup8').click(function() {
    $('#myPopup8').slideToggle();
});
});

$(document).ready(function(){
	$('#myPopup9').hide();
$('#popup9').click(function() {
    $('#myPopup9').slideToggle();
});
});

$(document).ready(function(){
$('#abroad').click(function() {
    $('#country_name').show();
});

});

$(document).ready(function() {
    	$('#country_name').hide();

$('#nepal').click(function()
{
	$('#country_name').hide();
	}
);

});

$(document).ready(function(){
$('#no').click(function() {
    $('#delivery').hide();
});
});
$(document).ready(function(){
$('#yes').click(function() {
    $('#delivery').show();
});
});

$(document).ready(function(){
	    $('#reason').hide();

$('#none').click(function() {
    $('#reason').slideToggle();
});
});

$(document).ready(function(){
$('#service').click(function() {
		$('#bought_from').hide();
		$('#quantity').hide();
	    $('#offer').hide();
	    $('#used_for').hide();
	    $('#market_price').hide();
	    $('#document_no').hide();
	    $('#home_delivery').hide();
	    $('#delivery').hide();
		$('#delivery_charge').hide();
	    $('#warranty').hide();
});
});

$(document).ready(function(){
$('#event').click(function() {
		$('#bought_from').hide();
		$('#quantity').hide();
	    $('#offer').hide();
	    $('#used_for').hide();
	    $('#market_price').hide();
	    $('#document_no').hide();
	    $('#home_delivery').hide();
	    $('#delivery').hide();
		$('#delivery_charge').hide();
	    $('#warranty').hide();
});
});

$(document).ready(function(){
$('#new').click(function() {
		$('#bought_from').show();
		$('#quantity').show();
	    $('#offer').show();
	    $('#used_for').hide();
	    $('#market_price').show();
	    $('#document_no').show();
	    $('#home_delivery').show();
	    $('#delivery_charge').show();
	    $('#warranty').show();
});
});

$(document).ready(function(){
$('#used').click(function() {
		$('#bought_from').show();
		$('#quantity').show();
	    $('#offer').show();
	    $('#used_for').show();
	    $('#market_price').show();
	    $('#document_no').show();
	    $('#home_delivery').show();
	    $('#delivery').show();
	    $('#warranty').show();
});
});

$(document).ready(function(){
	$("#yes").click(function(){
		$('#delivery_charge').show();
	});

	$("#no").click(function(){
		$('#delivery_charge').hide();
	});
});
