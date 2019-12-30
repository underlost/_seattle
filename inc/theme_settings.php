<?php
// create custom plugin settings menu
add_action('admin_menu', 'theme_options_menu');

function theme_options_menu() {
  //create new top-level menu
  add_menu_page('Theme Options', 'Theme Options', 'administrator', '_seattle-options', 'theme_options_page', 'dashicons-admin-generic', 60);
  //call register settings function
  add_action('admin_init', 'register_theme_options');
}

//register our settings
function register_theme_options() {
  register_setting('main-options', 'site_logo');
  register_setting('main-options', 'social_facebook');
  register_setting('main-options', 'social_twitter');
  register_setting('main-options', 'social_instagram');
  register_setting('main-options', 'extra_header_scripts');
}

function load_wp_media_files() {
  wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'load_wp_media_files');

function theme_options_page() {
  ?>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('.upload-btn').click(function(e) {
        e.preventDefault();
        var input = $(this).prev('.upload-target');
        var image = wp.media({
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            input.val(image_url);
        });
    });
});
</script>
<div class="wrap">
<h1>Theme Options</h1>
<form method="post" action="options.php">
    <?php settings_fields('main-options'); ?>
    <?php do_settings_sections('main-options'); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Site Logo</th>
            <td>
                <img src="<?php echo get_option('site_logo'); ?>" width="300" height="auto" /><br>
                <label for="upload_image">
                    <input class="upload-target" id="site_logo" type="text" size="36" name="site_logo" value="<?php echo get_option('site_logo'); ?>" />
                    <input class="upload-btn" type="button" value="Upload Image" />
                    <br /><p class="description">Enter an URL or upload an image for the site logo.</p>
                </label>
            </td>
        </tr>
        <tr>
            <th scope="row">Facebook URL</th>
            <td>
                <input id="social_facebook" name="social_facebook" class="regular-text code" type="url" value="<?php echo get_option('social_facebook'); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">Twitter URL</th>
            <td>
                <input id="social_twitter" name="social_twitter" class="regular-text code" type="url" value="<?php echo get_option('social_twitter'); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">Instagram URL</th>
            <td>
                <input id="social_instagram" name="social_instagram" class="regular-text code" type="url" value="<?php echo get_option('social_instagram'); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">Extra Header Scripts</th>
            <td>
                <textarea id="extra_header_scripts" name="extra_header_scripts" class="widefat" rows="10"><?php echo get_option('extra_header_scripts'); ?></textarea>
                <p class="description">Any extra header scripts for things like tracking and analytics.</p>
            </td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php
} ?>
