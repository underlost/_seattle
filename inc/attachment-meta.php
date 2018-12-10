<?php

//Adds meta to file attachements for grid sizing.

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'attachment_meta_boxes_setup' );
add_action( 'load-post-new.php', 'attachment_meta_boxes_setup' );

/* Meta box setup function. */
function attachment_meta_boxes_setup() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'attachment_meta_boxes' );

  /* Save post meta on the 'save_post' hook. */
  add_action( 'save_post', 'save_attachment_meta', 10, 2 );
}

function attachment_meta_boxes(){
    add_meta_box( 'post_meta_box', 'Post Settings', 'render_attachment_meta_box', 'attachment', 'side', 'high');
}

function render_attachment_meta_box($object, $box){
    global $image_size_options;
    global $image_height_options;
    $curr_img_size = get_post_meta($object->ID, 'display-img-size', true);
    if(empty($curr_img_size)) { $curr_img_size = 'col-md-4'; }
    $curr_height_size = get_post_meta($object->ID, 'display-img-height', true);
    if(empty($curr_height_size)) { $curr_height_size = 'grid-md'; }

    wp_nonce_field( basename( __FILE__ ), 'post_meta_nonce' ); ?>

    <p>
      <strong>Image Width</strong>
      <br />
      <select name="display-img-size">
          <?php foreach($image_size_options as $key => $val){ ?>
              <option value="<?php echo $key; ?>" <?php if($key == $curr_img_size){ echo "selected"; }?>><?php echo $val; ?></option>
          <?php } ?>
      </select>
    </p>

    <p>
      <strong>Image Height</strong>
      <br />
      <select name="display-img-height">
          <?php foreach($image_height_options as $key => $val){ ?>
              <option value="<?php echo $key; ?>" <?php if($key == $curr_height_size){ echo "selected"; }?>><?php echo $val; ?></option>
          <?php } ?>
      </select>
    </p>
<?php
}

/* Save the meta box's post metadata. */
function save_attachment_meta(){
     global $post;
     if( isset( $_POST['display-img-size'] ) ){
           update_post_meta( $post->ID, 'display-img-size', $_POST['display-img-size'] );
     }
     if( isset( $_POST['display-img-height'] ) ){
           update_post_meta( $post->ID, 'display-img-height', $_POST['display-img-height'] );
     }
}
add_action('edit_attachment', 'save_attachment_meta');
