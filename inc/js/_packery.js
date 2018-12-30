var grid = undefined;

jQuery(window).on('load', function() {
    grid = jQuery('.grid').packery({
        itemSelector: '.grid-item', // use a separate class for itemSelector, other than .col-
        percentPosition: true,
        layoutMode: 'packery',
        columnWidth: '.grid-sizer',
    });

    // Set custom post type for search
    var post_type = jQuery('.post-grid').data('post-type');
    jQuery('#search_post_type').val(post_type);
});
