$(document).ready(function(){
	for (var i = 0; i < 24; i++) {
		$("#pokemon-wrapper").append("<div id='generate-pokemon'><div class='img-thumbnail col-2 d-inline-block'><img src='{{asset('assets/logo.png')}}' class='img-fluid' width='90' alt=''></div>");
	}
});