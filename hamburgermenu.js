$(document).ready(function() {
    // run test on initial page load
    checkSize();

    // run test on resize of the window
    $(window).resize(checkSize);
});

//Function to the css rule
function checkSize(){
    if ($("#hamburger").css("display") == "block" ){
        $( "#cross" ).hide();//nascondi cross e menù
		$( "#breadcrumb .nav" ).hide();
		$( "#hamburger" ).click(function() {//quando clikki su hamburger
			$( "#breadcrumb .nav" ).slideToggle( "slow", function() {//function() è un callback
				$( "#hamburger" ).hide();
				$( "#cross" ).show();
			});
		});

		$( "#cross" ).click(function() {
			$( "#breadcrumb .nav" ).slideToggle( "slow", function() {
				$( "#cross" ).hide();
				$( "#hamburger" ).show();
			});
		});
    }
}