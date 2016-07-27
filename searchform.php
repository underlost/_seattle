<?php
/**
 * This template displays the search form.
 *
 * @package Seattle
 */
?>

<form role="search" method="get" id="searchform" class="searchform form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'seattle' ); ?></label>

		<input type="text" class="form-control" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search here...', 'seattle' ); ?>" />

		<button type="submit" id="searchsubmit" class="btn btn-primary">
			<i class="fa fa-search"></i> <span><?php echo esc_html_e( 'Search', 'seattle' ); ?></span>
		</button>
	</div>
</form>
