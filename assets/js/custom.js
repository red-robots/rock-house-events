/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});

	
	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();


	$(document).on("click","#toggleMenu",function(){
		$(this).toggleClass('open');
		$('.mobile-navigation').toggleClass('open');
		$('body').toggleClass('open-mobile-menu');
		$("#site-navigation").toggleClass('open-menu');
	});

	$(document).on("click","#events_pagination a",function(e){
		e.preventDefault();
		var parts = $(this).attr('href');
		var res = parts.split("?pg=");
		var pagenum = res[1];
		if(currentPage) {
			var new_url = currentPage + '?pg=' + pagenum;
			$("#upcoming_events_list").load( new_url + ' .innerpad_content');
			$("#events_pagination").load( new_url + ' .pageinner');
			window.history.replaceState( null, null, new_url );
		}
	});

	$(document).on("click","#old_events_pagination a",function(e){
		e.preventDefault();
		var parts = $(this).attr('href');
		var res = parts.split("?pastpg=");
		var pagenum = res[1];
		if(currentPage) {
			var new_url = currentPage + '?pastpg=' + pagenum;
			$("#past_events_list").load( new_url + ' #past_events_inner');
			window.history.replaceState( null, null, new_url );
		}
	});

});// END #####################################    END