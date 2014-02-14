$(document).ready(function() {
	$("button#resources").click(function() {
		alert("This doesn't necessarily work yet");
	});
	var largeMain = true;
	$(window).scroll(function() {
		if ($(window).scrollTop() > 418 && largeMain == true) {
			largeMain = false;
			$("#header-small").stop().animate({
				top: "0"
			}, 200);
		} else if ($(window).scrollTop() <= 418 && largeMain == false) {
			largeMain = true;
			$("#header-small").stop().animate({
				top: "-70px"
			}, 200);
		}
	});
});
var toggleAbout = function(val) {
	if (val) {
		$("#shadow").fadeIn();
		$("#about").animate({
			top: "50%"
		}, 800);
		
	} else {
		$("#shadow").fadeOut();
		$("#about").animate({
			top: "-400px"
		}, 600);
	}
}
var toggleSignUp = function(val) {
	if (val) {
		$("#shadow").fadeIn();
		$("#signup").animate({
			top: "50%"
		}, 800);
	} else {
		$("#shadow").fadeOut();
		$("#signup").animate({
			top: "-400px"
		}, 600);		
	}
}
var sayThankYou = function() {
		$("#shadow").fadeIn();
		$("#thankyou").fadeIn();
		$("#shadow").delay(1500).fadeOut();
		$("#thankyou").delay(1500).fadeOut();		
}