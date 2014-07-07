<?php //

function getFirstImage() {
	global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  if(empty($first_img)) {
    $first_img = "";
  }
  return $first_img;
}


// thumbnail inclusion
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 180, 270 );
add_image_size( 'small-thumb', 180, 9999 );
add_image_size('pattern-thumb', 400, 232, true);

function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_theme_support( 'custom-header' );

function new_excerpt_more( $more ) {
	return ' [...]';//<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More</a>
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

add_action( 'init', 'create_post_type' );
function create_post_type() {
	
	$labels = array(
		'name' => _x('Patterns', 'Patterns general name'),
		'singular_name' => _x('Pattern', 'deail type singular name'),
		'add_new' => _x('Add New', 'pattern post'),
		'add_new_item' => __('Add New pattern post'),
		'edit_item' => __('Edit Pattern post'),
		'new_item' => __('New Pattern post'),
		'view_item' => __('View Pattern post'),
		'search_items' => __('Search Patterns'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		/*'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,*/
		'rewrite' => array('slug' => 'patterns'),
		/*'capability_type' => 'post',*/
		'hierarchical' => true,
		'menu_position' => 4,
		'supports' => array( 'title', 'editor', 'comments', 'excerpt', 'custom-fields', 'thumbnail', 'tags' ),
        'taxonomies' => array('post_tag', 'category')
	  );
	  
	register_post_type('patterns', $args);
}

update_option('image_default_link_type','none');

add_filter('get_search_form', 'my_search_form');
 
function my_search_form($text) {
     $text = str_replace('value="Search"', 'value=""', $text);
     return $text;
}

add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'p',
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);

    $selector = "gallery-{$instance}";

    $output = apply_filters('gallery_style', "<div id='$selector' class='gallery galleryid-{$id} clearfix'>");

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        //$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, true, false) : wp_get_attachment_link($id, $size, true, false);
		$url = wp_get_attachment_url($id);
		$thumb = wp_get_attachment_image_src($id, "pattern-thumb");//wp_get_attachment_thumb_url($id);
		$link = "<a href = '".$url."'><img src = '".$thumb[0]."' /></a>";
        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
    }

    $output .= "</{$selector}>";

    return $output;
}

function boxout_function($atts, $content) {
	$boxString = "<div class = 'boxout'><span>";
	$boxString .= $content;
	$boxString .= "</span></div>";
	return $boxString;
}

add_shortcode('boxout', 'boxout_function');

add_action( 'widgets_init', 'my_register_sidebars' );

function my_register_sidebars() {

	/* Register the 'primary' sidebar. */
	register_sidebar(
		array(
			'id' => 'primary',
			'name' => __( 'Primary' ),
			'description' => __( 'Sidebar for main blog content' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'footer_content',
			'name' => __( 'Footer content' ),
			'description' => __( 'Sidebar in footer' ),
			'before_widget' => '<div id="%1$s" class="footerWidget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'about_sidebar',
			'name' => __( 'About sidebar' ),
			'description' => __( 'Sidebar in about' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	
	register_sidebar(
		array(
			'id' => 'about_sidebar_left',
			'name' => __( 'About sidebar Left' ),
			'description' => __( 'Sidebar in about lefthand-side' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);

	/* Repeat register_sidebar() code for additional sidebars. */
}

if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

add_post_type_support( 'page', 'excerpt' );

add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->term_id}.php") ) return TEMPLATEPATH . "/single-{$cat->term_id}.php"; } return $t;' ));

add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
function fixed_img_caption_shortcode($attr, $content = null) {
    if ( ! isset( $attr['caption'] ) ) {
        if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
        $content = $matches[1];
        $attr['caption'] = trim( $matches[2] );
        }
    }

    $output = apply_filters('img_caption_shortcode', '', $attr, $content);
    if ( $output != '' )
    return $output;

    extract(shortcode_atts(array(
        'id' => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) )
    return $content;

    if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

    return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >' . do_shortcode( $content ) . '<p class = "wp-caption-text">' . $caption . '</p></div>';
}

//remove inline width and height added to images
add_filter( 'wp_get_attachment_image', 'remove_thumbnail_dimensions', 10 );
add_filter( 'wp_get_attachment_link', 'remove_thumbnail_dimensions', 10 );
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'attachment-thumbnail', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
// Removes attached image sizes as well
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

// add a favicon to your 
function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
add_action('wp_head', 'blog_favicon');

?>