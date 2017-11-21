$( function(){


	$('#img_menu').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		$('#menu').animate({width:'300px'},500);
		$('#menu li').show();
		$('#menu li').animate({width:'300px'},500);
	});

	$(document).on('click', function(event) {
		/* Act on the event */
		if(event.target.id!=null&&event.target.id!="menu" && $("#menu").width()==300){
			$('#menu').animate({width:'0px'},500);
			$('#menu li').animate({width:'0px'},500,function() {
				// body...
				$('#menu li').hide();
			});
		}
	});

	$('#menu li').click(function(event) {
		event.preventDefault();
		$href = $(this).children('a').attr('href');
		window.location.replace($href);
	});

	$('#sair').click(function(event) {
		/* Act on the event */
		window.location.replace('logout.php');

	});
});
