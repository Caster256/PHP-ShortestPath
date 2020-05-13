$(document).on("pageinit", function() {
	$('#login_form').hide();
	$('#login_img').hide();
	//$('#QA_form').hide();
	$('#main_login').click(function () {
		$('#login_form').toggle('slow');
		$('#login_img').hide('slow');
		//$('#QA_form').hide('slow');
	});
	$('#other_login').click(function () {
		$('#login_img').toggle('slow');
		$('#login_form').hide('slow');
		//$('#QA_form').hide('slow');
	});
	/*$('#QA').click(function () {
		$('#QA_form').toggle('slow');
		$('#login_form').hide('slow');
		$('#google_login').hide();
	});*/
});