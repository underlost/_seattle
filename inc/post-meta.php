<?php

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'post_meta_boxes_setup' );

/* Meta box setup function. */
function post_meta_boxes_setup() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'post_meta_boxes' );

  /* Save post meta on the 'save_post' hook. */
  add_action( 'save_post', 'save_post_meta', 10, 2 );
}

function post_meta_boxes(){
    add_meta_box( 'post_meta_box', 'Post Meta', 'render_post_meta_box', 'post', 'side', 'high');
}

function render_post_meta_box($object, $box){
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

    <p>
        <label for="source-name">Source Name</label>
        <input type="text" name="source-name" id="source-name" value="<?php echo get_post_meta($object->ID, 'source-name', true); ?>"/>
    </p>
    <p>
        <label for="source-url">Source URL</label>
        <input type="text" name="source-url" id="source-url" value="<?php echo get_post_meta($object->ID, 'source-url', true); ?>"/>
    </p>
<?php
}

/* Save the meta box's post metadata. */
function save_post_meta( $post_id, $post ) {

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['post_meta_nonce'] ) || !wp_verify_nonce( $_POST['post_meta_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    $size_meta = get_post_val('display-img-size');
    update_post_meta($post_id, 'display-img-size', $size_meta);

    $size_height_meta = get_post_val('display-img-height');
    update_post_meta($post_id, 'display-img-height', $size_height_meta);

    $source_meta = get_post_val('source-name');
    update_post_meta($post_id, 'source-name', $source_meta);

    $url_meta = get_post_val('source-url');
    update_post_meta($post_id, 'source-url', $url_meta);
}
