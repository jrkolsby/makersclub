function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}
$(document).ready(function() {
	$("textarea").each(function() {
		textAreaAdjust(this);
	});
	$("form.post").mouseenter(function() {
		$(this).children("button.submit").stop().animate({
			opacity: 0.75
		}, 300);
		$(this).children("button.delete").stop().animate({
			opacity: 0.75
		}, 300);
	});
	$("form.post").mouseleave(function() {
		$(this).children("button.submit").stop().animate({
			opacity: 0
		}, 300);
		$(this).children("button.delete").stop().animate({
			opacity: 0
		}, 300);
	});
	$("form.post button.submit").mouseenter(function() {
		$(this).animate({
			opacity: 1
		}, 100);
	});
	$("form.post button.submit").mouseleave(function() {
		$(this).animate({
			opacity: 0.75
		}, 100);
	});
	$("form.post button.delete").mouseenter(function() {
		$(this).animate({
			opacity: 1
		}, 100);
	});
	$("form.post button.delete").mouseleave(function() {
		$(this).animate({
			opacity: 0.75
		}, 100);
	});
	$("form.post button.delete").click(function() {
		if (confirm("Are you sure?")) {
			$(this).parent("form").children("input.del").val("1");
			$(this).parent("form").submit();
		}
	});
	$("#add").click(function() {
		$("form#new").fadeIn();
		$(this).animate({
			marginTop: "-102px",
			opacity: 0		
		}, function() {
			$(this).css("display", "none");
		});
	});
});