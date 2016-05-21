<?php
/*
Plugin Name: ActionPress
Plugin URI:  http://github.com/NickCousins/ActionPress
Description: Make your "read more" links a bespoke call-to-action for each post.
Version:     1.0
Author:      Nick Cousins
Author URI:  http://github.com/NickCousins
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


/**
 * Meta box markup
 *
 * @param $object
 */
function actionpress_metabox_markup( $object )
{
    wp_nonce_field( basename( __FILE__ ), "meta-box-nonce" );

    ?>
    <div>
        <input style="width:100%" type="text" name="post_action_text"
               placeholder="Read more"
               value="<?php echo get_post_meta( $object->ID, "post_action_text", true ); ?>"/>

        <p class="howto">Customise the text of your "read more" link</p>
    </div>
<?php
}

/**
 * Register the meta box
 */
function actionpress_metabox()
{
    add_meta_box( "actionpress_metabox", "Post Action", "actionpress_metabox_markup", "post", "side", "high", null );
}

/**
 * Save the action text on post save
 *
 * @param $post_id
 * @param $post
 * @param $update
 *
 * @return mixed
 */
function actionpress_savepost( $post_id, $post, $update )
{
    if ( !isset( $_POST[ "meta-box-nonce" ] ) || !wp_verify_nonce( $_POST[ "meta-box-nonce" ], basename( __FILE__ ) )
    ) {
        return $post_id;
    }

    if ( !current_user_can( "edit_post", $post_id ) ) {
        return $post_id;
    }

    if ( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    $slug = "post";
    if ( $slug != $post->post_type ) {
        return $post_id;
    }

    $post_action_text = "";

    if ( isset( $_POST[ "post_action_text" ] ) ) {
        $post_action_text = $_POST[ "post_action_text" ];
    }
    update_post_meta( $post_id, "post_action_text", $post_action_text );

}

/**
 * Replaces the More link with an ActionPress one
 *
 * @param $link
 *
 * @return string
 */
function actionpress_excerptmore( $link )
{
    global $post;

    $readMoreText = get_post_meta( $post->ID, "post_action_text", true );

    $readMoreText = !empty( $readMoreText ) ? $readMoreText : 'Read more';

    return '<a class="actionpress_more more-link" href="' . get_the_permalink( $post->ID ) . '">' . $readMoreText . '</a>';
}

/**
 * Enqueue the default stylesheet
 */
function actionpress_style()
{
    wp_enqueue_style( 'actionpress', plugins_url('actionpress.css', __FILE__) );
}

/**
 * Hook everything into Wordpress
 */
add_action( "add_meta_boxes", "actionpress_metabox" );
add_action( "save_post", "actionpress_savepost", 10, 3 );
add_filter( "excerpt_more", "actionpress_excerptmore", 20, 1 );
add_action( 'wp_enqueue_scripts', 'actionpress_style' );