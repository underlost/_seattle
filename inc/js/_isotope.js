// Unused

var grid = undefined;

jQuery(document).ready(function(){
    grid = jQuery('.grid').isotope({
        itemSelector: '.grid-item', // use a separate class for itemSelector, other than .col-
        percentPosition: true,
        //layoutMode: 'fitRows',
        masonry: {
            columnWidth: '.grid-sizer'
        }
    });

    // Set custom post type for search
    var post_type = jQuery('.post-grid').data('post-type');
    jQuery('#search_post_type').val(post_type);
});

check_active_filters = function(){
    // Hide the active filter container if no filters are left, then show all cards.
    if(jQuery("#active-filters").children().length == 0){
        jQuery("#active-filter-container").hide();
        grid.isotope({ filter: '*' });
    }
}

function reload_grid(){
    grid.isotope('reloadItems').isotope();
}
