<?php

function entrada_visual_composer_update_existing_shortcodes(){
	if ( function_exists( 'vc_add_params' ) ) {

		$attributes = array(
		    array(
				"type" 			=> "dropdown",
				"group" 		=> "Entrada Additions",
				"class" 		=> "",
				"heading" 		=> "Block Content Width",
				"param_name" 	=> "wrapper_container",
				"value" 		=> array(
						
						"In Container" 								=> "theme-container",					
						"Full Width Content" 						=> "content-block",
						"No Container" 								=> "no-container",
						"Full Width Content with no padding/margin" => "content-block-no-padding-margin",
						"Call To Action" 							=> "special-block",
						"Adventure Style" 							=> "adventure-style",
						"Product Listing Block (Home Page)" 		=> "product-list-block",
						"Guide Block" 								=> "guide-block",
						"Featured Tour Block" 						=> "featured-product-block",	
						"Browse Block" 								=> "browse-block",
						"Partner Block" 							=> "partner-block",
						"Services Block (Home Page)" 				=> "services-block",
						"Counter Block" 							=> "count-block",
						"Testimonial Container" 					=> "testimonial-block",
						"Services Block (About Page)" 				=> "about-service-block",
						"Step Block (About Page)" 					=> "step-block",
						"services Section (About Page)" 			=> "services-section"
					)
		    ),
		    array(
					"type" 			=> "dropdown",
					"group" 		=> "Entrada Additions",
					"class" 		=> "",
					"heading" 		=> "Block Background Color",
					"param_name" 	=> "entrada_row_bgcolor",
					"value" 		=> array(
										"Default" 			=> "",
										"Gray Background" 	=> "bg-gray",
										"White Background" 	=> "bg-white",					
									)
		    )
		);

		vc_add_params( 'vc_row', $attributes ); 
		

	}
}
add_action( 'wp_loaded', 'entrada_visual_composer_update_existing_shortcodes' );

?>