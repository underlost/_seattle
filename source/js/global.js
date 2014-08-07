/* ========================================================================
 * global.js
 * all the extra bits of JS for seattle theme.
 * ======================================================================== */

// masonry
$(window).load(function() {

  $('div.thumbs').masonry({
    itemSelector: 'div.thumb',
    columnWidth: 213,
  });

});

jQuery(document).ready(function($) { //noconflict wrapper
    $('input#submit').addClass('btn');
});//end noconflict

// COLORBOX
$(document).ready(function() {
    if ($(window).width() > 960) {
        $(".expand a, .thumbs a, .images a").colorbox({
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
