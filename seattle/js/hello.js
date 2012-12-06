// COLORBOX
$(document).ready(function() {
	if ($(window).width() > 960) {
		$(".photo a, .thumbs a, .images a").colorbox({
			transition:"elastic", 
			maxWidth:"98%", 
			maxHeight:"98%"
		});
		$("a.lightbox").colorbox({
			transition:"elastic",
			maxWidth:"98%",
			maxHeight:"98%"
		});
	}
});

// masonry
$(function(){
  
  $('.thumbs').masonry({
    itemSelector: '.thumb',
    columnWidth: 200
  });
  
});

jQuery(document).ready(function($) { //noconflict wrapper
    $('input#submit').addClass('btn');
});//end noconflict