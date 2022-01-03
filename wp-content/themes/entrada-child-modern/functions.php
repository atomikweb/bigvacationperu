<?php
// Entrada Child - Modern function start here
add_action('wp_enqueue_scripts', 'entrada_child_scripts', 12);

function entrada_child_scripts()
{
    if (is_rtl()) {
        wp_enqueue_style('entrada-child-rtl', get_template_directory_uri() . "/rtl.css");
    }
}

// Function to remove call to retina images. Delete to use retina images
function entrada_dequeue_script()
{
    wp_dequeue_script('entrada-retina-js');
}
add_action('wp_print_scripts', 'entrada_dequeue_script', 100);

// Add your custom functions below this line and above closing php tag! */

/* Custom Destination Text */
add_action( 'init', 'entrada_destination_url_rewrite' );
if( ! function_exists( 'entrada_destination_url_rewrite' ) ) {
    function entrada_destination_url_rewrite() {
        
        $custom_text = 'destinos'; // Change this value to what you want to show inplace of destination
        
        add_rewrite_rule( "^". $custom_text ."/([^/]*)$", 'index.php?destination=$matches[1]', 'top' );
        add_rewrite_rule( "^". $custom_text ."/([^/]*)/([^/]*)$", 'index.php?destination=$matches[2]', 'top' );
    }
}

add_filter( 'term_link', 'entrada_change_destination_permalink', 10, 3 );
if( ! function_exists( 'entrada_change_destination_permalink' ) ) { 
	function entrada_change_destination_permalink( $url, $term, $taxonomy ) {
	
	    $custom_text = 'destinos'; // Change this value to what you want to show inplace of destination
	
	    $taxonomy_name = 'destination';
	    $taxonomy_slug = 'destination';
	 
	    // exit the function if taxonomy slug is not in URL
	    if ( strpos( $url, $taxonomy_slug ) === FALSE || $taxonomy != $taxonomy_name ) return $url;
	    $url = str_replace( '/' . $taxonomy_slug, '/' . $custom_text, $url );
	    return $url;
	}
}

?>