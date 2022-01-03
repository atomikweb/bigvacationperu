<?php

include('entrada_vc_icomoon_list.php');



/* Entrada VC Extended Elements

---------------------------------------------------------- */

add_action( 'vc_before_init', 'Entrada_integrateWithVC' );

function Entrada_integrateWithVC() {

global $icon_array;	
$product_cat_lists = array();
$tour_listings = array();

/* Get All tour 
..................... */
	$args = array( 
				'post_type'		 =>  'product',
				'showposts'  	 =>  -1,
				'orderby'        => 'date',
				'order'          => 'desc'
			);
	$args = entrada_vc_product_type_meta_query($args, 'tour' );
	$featured_query = new WP_Query( $args );
	if ($featured_query->have_posts()) :
		while ($featured_query->have_posts()) :     
		$featured_query->the_post();

		$tour_listings[] =	array(
								'label' => get_the_title(),
								'value' => get_the_ID(),
								);

		endwhile;
	endif;

$post_types = get_post_types( array() );

$prod_cat_args = array (
						'orderby'                => 'name',
						'order'                  => 'ASC',
						'hide_empty'             => 0
					);

$product_cats = get_terms( 'product_cat', $prod_cat_args );

if($product_cats) {
	foreach( $product_cats as $product_cat ) { 
		if(array_key_exists('term_id', $product_cat) ) {
		$product_cat_lists[$product_cat->name] = $product_cat->term_id;
		}
	}
}

$post_types_list = array();

if ( is_array( $post_types ) && ! empty( $post_types ) ) {

	foreach ( $post_types as $post_type ) {

		if ( $post_type !== 'revision' && $post_type !== 'nav_menu_item' ) {

			$label = ucfirst( $post_type );

			$post_types_list[] = array( $post_type, $label );

		}

	}

}



$grid_display_style_lists = array(
				array( 'label' => 'Guide', 'value' =>'guide' ),
				array( 'label' => 'Partner', 'value' => 'partner' ),
				array( 'label' => 'Testiminials', 'value' => 'testiminial' ),
			);



$page_list = array();

$mypages = get_pages( array( 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );

if($mypages){

	foreach( $mypages as $page ) {	

		$page_list[] = array( $page->ID, $page->post_title );

		}

	}

	

  /*  Entrada VC Browse Page Block
---------------------------------------------------------- */
   vc_map( array(

      'name' => __('Link Block', 'entrada' ),
      'base' => 'browse_link_block',
	  'description'   => 'Navigation block pattern.',
      'class' => '',
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      'category' => __('Entrada Shortcodes', 'entrada'),
	  "controls" => "full",
	  'content_element' => true,
      'params' => array(
          array(
				  'type' => 'textfield',
				  'holder' => 'div',
				  "class" => "",
				  'heading' => __('Text', 'entrada'),
				  'param_name' => 'browse_block_title',
				  'value' => __('', 'entrada'),
				  'description' => __('Text for link block.', 'entrada')
              ),

		 array(	
				'type' => 'dropdown',
				'heading' => __( 'Block Display Style', 'entrada' ),
				'param_name' => 'browse_block_display_style',
				'value' => array(
								__( 'Destinations', 'entrada' ) => 'destinations',
								__( 'Adventures', 'entrada' ) => 'adventures'
							),
				'std' => 'destinations',
				'description' => __( 'Block display style.', 'entrada' )

		),

		 array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "URL", "entrada" ),
            "param_name" => "browse_block_url", 
            "value" => __( "", "entrada" ),
            "description" => __( "Enter block url.", "entrada" )
         )

      )

   ) );

	

/*  Entrada VC Heading/Sub-heading

---------------------------------------------------------- */	

   vc_map( array(

      "name" => "Entrada Heading",
      "base" => "bartag",
	  'description'   => 'Custom heading block.',
      "class" => "",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Heading Title", "entrada" ),
            "param_name" => "entrada_heading",
            "value" => __( "Default heading", "entrada" ),
            "description" => __( "Description for Heading.", "entrada" )
         ),

         array(

            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Sub-heading", "entrada" ),
            "param_name" => "content", 
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "entrada" ),
            "description" => __( "Enter your sub-heading.", "entrada" )
         )

      )

   ) );
   
/*  Entrada Search
---------------------------------------------------------- */
   vc_map( array(

      'name' => __('Search Block', 'entrada' ),
      'base' => 'entrada_search_block',
	  'description'   => 'Add search block.',
      'class' => '',
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      'category' => __('Entrada Shortcodes', 'entrada'),
	  "controls" => "full",
	  'content_element' => true,
      'params' => array(
          array(
				  'type' => 'textfield',
				  'holder' => 'div',
				  "class" => "",
				  'heading' => __('Text', 'entrada'),
				  'param_name' => 'search_block_title',
				  'value' => __('', 'entrada'),
				  'description' => __('Text for search block.', 'entrada')
              ),
			  
		 array(
				  'type' => 'exploded_textarea',
				  'holder' => 'div',
				  "class" => "",
				  'heading' => __('Search Elements', 'entrada'),
				  'param_name' => 'search_block_desc',
				  'value' => __('', 'entrada'),
				  'description' => __('Add search element here. Label Title:: search_type::Default Selected Value. (Example: Select Your Destination::destination::All Destinations). Must match format as shown.<code> <strong>search_type:</strong> <br />destination <br />destination_level_1<br />activity <br />start_date<br />end_date<br />start_month_year_selectbox<br />end_month_year_selectbox<br />price_range</code>', 'entrada')
              ),
		  array(
				  'type' => 'textfield',
				  'holder' => 'div',
				  "class" => "",
				  'heading' => __('Search Button Title', 'entrada'),
				  'param_name' => 'search_block_button_text',
				  'value' => __('', 'entrada'),
				  'description' => __('Title for search button.', 'entrada')
              ),	
			  
			array(	
				'type' => 'dropdown',
				'heading' => __( 'Field column', 'entrada' ),
				'param_name' => 'search_field_col',
				'value' => array(
								__( '2 - Columns', 'entrada' ) => '2',
								__( '3 - Columns', 'entrada' ) => '3', 
								__( '4 - Columns', 'entrada' ) => '4',
								__( '5 - Columns', 'entrada' ) => '5'
							),
	
				'std' => '3',
				'description' => __( 'Select number of column to show fields.', 'entrada' )
		),  
			  
     	 )

   ) );	 

   /*  Entrada VC Clients/Partner
---------------------------------------------------------- */

   vc_map( array(
      "name" => __( "Post Grid", "entrada" ),
      "base" => "entradapostgrid",
	  'description'   => 'Data Grid from custom post type.',
      "class" => "",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Title", "entrada" ),
            "param_name" => "entrada_postgrid_title",
            "value" => __( "", "entrada" ),
            "description" => __( "Description for post grid.", "entrada" )
         ),

		 array(
			'type' => 'dropdown',
			'heading' => __( 'Data source', 'entrada' ),
			'param_name' => 'post_type',
			'value' => $post_types_list,
			'save_always' => true,
			'description' => __( 'Select content type for your grid.', 'entrada' )
		),

		array(	
			'type' => 'dropdown',
			'heading' => __( 'Display Style', 'entrada' ),
			'param_name' => 'display_style',
			'value' => array(
							__( 'Guide', 'entrada' ) => 'guide',
							__( 'Testimomials', 'entrada' ) => 'testimonial', 
							__( 'Partner', 'entrada' ) => 'partner',
							__( 'Featured Tour', 'entrada' ) => 'featured_tour',							
							__( 'Popular Tour', 'entrada' ) => 'popular_tour',
							__( 'Top Adventure', 'entrada' ) => 'top_adventure'
						),

			'std' => 'guide',
			'description' => __( 'Select post type grid style.', 'entrada' )
		),

		array(	
			'type' => 'dropdown',
			'heading' => __( 'Columns', 'entrada' ),
			'param_name' => 'entrada_column',
			'value' => array(
							__( '2 Columns', 'entrada' ) => '6',
							__( '3 Columns', 'entrada' ) => '4', 
							__( '4 Columns', 'entrada' ) => '3',
							__( '6 Columns', 'entrada' ) => '2',			
						),

			'std' => '4',
			'description' => __( 'Select column.', 'entrada' )
		),

		  array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Total Item", "entrada" ),
            "param_name" => "total_item",
            "value" => __( "3", "entrada" ),
            "description" => __( "Description for total item.", "entrada" )
         ),

		// Data settings

	array(
		'type' => 'dropdown',
		'heading' => __( 'Order by', 'entrada' ),
		'param_name' => 'orderby',
		'value' => array(
			__( 'Date', 'entrada' ) => 'date',
			__( 'Post ID', 'entrada' ) => 'ID',
			__( 'Title', 'entrada' ) => 'title',
			__( 'Last modified date', 'entrada' ) => 'modified',
		),

		'description' => __( 'Select order type.', 'entrada' ),
		'group' => __( 'Data Settings', 'entrada' ),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),

	),	

	array(
		'type' => 'dropdown',
		'heading' => __( 'Sort order', 'entrada' ),
		'param_name' => 'order',
		'group' => __( 'Data Settings', 'entrada' ),
		'value' => array(
			__( 'Descending', 'entrada' ) => 'DESC',
			__( 'Ascending', 'entrada' ) => 'ASC',
		),

		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'description' => __( 'Select sorting order.', 'entrada' ),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),

	),

      )

   ) );

   

/*  Entrada VC Product Categories Gallery
---------------------------------------------------------- */

  vc_map( array(
      "name" => __( "Category Gallery", "entrada" ),
      "base" => "categoriesgallery",
	  'description'   => 'Galleries from Tour Category.',
      "class" => "",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Title", "entrada" ),
            "param_name" => "entrada_catgallery_title",
            "value" => __( "", "entrada" ),
            "description" => __( "Description for category gallery.", "entrada" )
         ),

		array(		
			'type' => 'dropdown',
			'heading' => __( 'Show/Hide Empty', 'entrada' ),
			'param_name' => 'showhide_empty',
			'value' => array(
							__( 'Hide Empty', 'entrada' ) => '1',
							__( 'Show Empty', 'entrada' ) => '0'
						),
			'std' => '1',
			'description' => __( 'Toggles the display of categories with no posts.', 'entrada' )
		),

	    array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Total Item", "entrada" ),
            "param_name" => "catgal_record_data",
            "value" => __( "", "entrada" ),
            "description" => __( "Description for total item.", "entrada" )
         ),

	    array(	
			'type' => 'dropdown',
			'heading' => __( 'Link', 'entrada' ),
			'param_name' => 'iconbar_nav_link',
			'value' => array(
							__( 'Product Category Page (recommended)', 'entrada' ) => 'default',
							__( 'Search Page', 'entrada' ) => 'search',
							__( 'Custom Page', 'entrada' ) => 'custom',
						),
			'std' => 'default',
			'description' => __( 'Toggles the link of iconbar.', 'entrada' )

		),

      )

   ) );
   
/*  Entrada VC Iconbar Navigation Element
---------------------------------------------------------- */

      vc_map( array(
      "name" => __( "Iconbar Nav", "entrada" ),
      "base" => "entrada_iconbarnav",
	  "description" => "Iconbar menu from Tour Category.",
      "class" => "",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(

         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Title", "entrada" ),
            "param_name" => "iconbar_nav_title",
            "value" => __( "", "entrada" ),
            "description" => __( "Add tilte for iconbar navigation.", "entrada" )
         ),

		array(	
			'type' => 'dropdown',
			'heading' => __( 'Show/Hide Empty', 'entrada' ),
			'param_name' => 'iconbar_nav_showhide_empty',
			'value' => array(
							__( 'Hide Empty', 'entrada' ) => 1,
							__( 'Show Empty', 'entrada' ) => 0
						),
			'std' => 1,
			'description' => __( 'Toggles the display of categories with no posts.', 'entrada' )

		),

	  array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Total Item", "entrada" ),
			"param_name" => "iconbar_nav_count",
			"value" => __( "8", "entrada" ),
			"description" => __( "Description for total item.", "entrada" )
	 ),

	  array(	
			'type' => 'dropdown',
			'heading' => __( 'Link', 'entrada' ),
			'param_name' => 'iconbar_nav_link',
			'value' => array(
							__( 'Product Category Page (recommended)', 'entrada' ) => 'default',
							__( 'Search Page', 'entrada' ) => 'search',
							__( 'Custom Page', 'entrada' ) => 'custom',
						),
			'std' => 'default',
			'description' => __( 'Toggles the link of iconbar.', 'entrada' )

		),

      )

   ) );


/*  Entrada VC Content Column Element
---------------------------------------------------------- */

      vc_map( array(

      "name" => __( "Content column", "entrada" ),
      "base" => "content_column",
	  "description" => "Custom block with navigation button.",
      "class" => "",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(

         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Title", "entrada" ),
            "param_name" => "content_column_title",
            "value" => __( "", "entrada" ),
            "description" => __( "Add content block title here.", "entrada" )
         ),

	     array(
				"type" 			 => "textarea",
				"holder" 		 => "div",
				"class"		 	 => "",
				"heading"   	 => __( "Description", "entrada" ),
				"param_name"	 => "content_column_desc",
				"value"     	 => __( "", "entrada" ),
				"description"	 => __( "Please add short description here.", "entrada" )
			 ),
			 
		array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Button Title", "entrada" ),
            "param_name" => "content_column_btn_title",
            "value" => __( "", "entrada" ),
            "description" => __( "Add button name here.", "entrada" )
         ),
		 
		array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Button Link", "entrada" ),
            "param_name" => "content_column_btn_link",
            "value" => __( "", "entrada" ),
            "description" => __( "Add button link here.", "entrada" )
         ),
		 
		array(	
			'type' => 'dropdown',
			'heading' => __( 'Block For', 'entrada' ),
			'param_name' => 'block_for',
			'value' => array(
							__( 'Home Page', 'entrada' ) => 'home',
							__( 'About Page (Top Block)', 'entrada' ) => 'about-top',
							__( 'About Page (Bottom Block)', 'entrada' ) => 'bottom-top'
						),
			'std' => 'home',
			'description' => __( 'Toggles the display of block for the page.', 'entrada' )

		),

      )

   ) );

/*  Entrada VC Call To Action
---------------------------------------------------------- */

      vc_map( array(
      "name" => __( "Call To Action ", "entrada" ),
      "base" => "call_to_action",
	  "description" => "Call to Action block.",
      "class" => "",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(

         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Title", "entrada" ),
            "param_name" => "callto_action_title",
            "value" => __( "", "entrada" ),
            "description" => __( "Add title here.", "entrada" )
         ),

	     array(
				
			 "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Description", "entrada" ),
            "param_name" => "content", 
            "value" => __( "Get special discount on select treks, this week.<strong> Call +1 5775 7525 </strong>", "entrada" ),

            "description" => __( "Add description here.", "entrada" )
			
			 ),
	
      )

   ) );

   /*  Entrada VC Counter
---------------------------------------------------------- */
 vc_map( array(
      "name" => __( "Entrada Counter", "entrada" ),
      "base" => "entrada_counter",
	  'description'   => 'Custom counter block.',	
      "class" => "",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Title", "entrada" ),
            "param_name" => "entrada_counter_title",
            "value" => __( "", "entrada" ),
            "description" => __( "Title for counter.", "entrada" )
         ),

		array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Counter Data", "entrada" ),
            "param_name" => "entrada_counter_data",
            "value" => __( "", "entrada" ),
            "description" => __( "Please enter counter data.", "entrada" )
         ),

	 array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Block Type", "entrada" ),
            "param_name" => "entrada_counter_block_model",
            'value' =>  array(
							__( 'Block Model 1', 'entrada' ) => 'block-1',
							__( 'Block Model 2', 'entrada' ) => 'block-2', 
							__( 'Block Model 3', 'entrada' ) => 'block-3',
							__( 'Block Model 4', 'entrada' ) => 'block-4'
					),
            "description" => __( "Please select block model.", "entrada" )

         ),

		array(	
			'type' => 'dropdown',
			'heading' => __( 'Choose Icon', 'entrada' ),
			'param_name' => 'entrada_counter_icon',
			'value' =>  $icon_array,
			'std' => '',
			'description' => __( 'Select icon.', 'entrada' )
		)

      )

   ) );

   

   /*  Entrada VC Telephone/ Fax Block
---------------------------------------------------------- */

vc_map( array(
      "name" => __( "Tel/Fax Block", "entrada" ),
      "base" => "entrada_telfax",
	  'description'   => 'Custom Tel/Fax block.',
      "class" => "",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Title", "entrada" ),
            "param_name" => "entrada_telfax_title",
            "value" => __( "", "entrada" ),
            "description" => __( "Title for Tel/Fax Block.", "entrada" )
         ),

		array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Tel/Fax Number", "entrada" ),
            "param_name" => "entrada_telfax_no",
            "value" => __( "", "entrada" ),
            "description" => __( "Please enter tel/fax number.", "entrada" )
         ),

		array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Block Class", "entrada" ),
            "param_name" => "entrada_telfax_block_class",
            "value" => __( "", "entrada" ),
            "description" => __( "Please enter block class.", "entrada" )
         ),

		array(	
			'type' => 'dropdown',
			'heading' => __( 'Choose Icon', 'entrada' ),
			'param_name' => 'entrada_telfax_icon',
			'value' => array(
							__( 'Telephone Big', 'entrada' ) => 'icon-tel-big',
							__( 'Fax Big', 'entrada' ) => 'icon-fax-big', 
							__( 'Telephone Small', 'entrada' ) => 'icon-tel'
						),
			'std' => 'icon-tel',
			'description' => __( 'Select icon.', 'entrada' )
		),

		 array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Short Description", "entrada" ),
            "param_name" => "content",
            "value" => __( "", "entrada" ),
            "description" => __( "Please enter short description.", "entrada" )
         )

      )

   ) );

   

 /*  Entrada VC Google Map iFrame
---------------------------------------------------------- */
 vc_map( array(
      "name" => __( "Google Map", "entrada" ),
      "base" => "entrada_googlemap",
	  'description'   => 'Custom Google map.',
      "class" => "",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Address", "entrada" ),
            "param_name" => "entrada_gmap_address",
            "value" => __( "", "entrada" ),
            "description" => __( "Address for Google Map. (Pariser Platz, 10117 Berlin)", "entrada" )
         ),		 

		 array(		
			'type' => 'dropdown',
			'heading' => __( 'Type', 'entrada' ),
			'param_name' => 'entrada_gmap_type',
			'value' => array(
							__( 'Road Map', 'entrada' ) => 'roadmap',
							__( 'Setelite', 'entrada' ) => 'setelite', 
							__( 'Hybrid', 'entrada' ) => 'hybrid', 
							__( 'Terrain', 'entrada' ) => 'terrain'
						),
			'std' => 'roadmap',
			'description' => __( 'Select map view.', 'entrada' )
		),

	 array(	
			'type' => 'dropdown',
			'heading' => __( 'Zoom', 'entrada' ),
			'param_name' => 'entrada_gmap_zoom',
			'value' => array(
							__( '7', 'entrada' ) => '7',
							__( '8', 'entrada' ) => '8', 
							__( '9', 'entrada' ) => '9', 
							__( '10', 'entrada' ) => '10',
							__( '11', 'entrada' ) => '11',
							__( '12', 'entrada' ) => '12',
							__( '13', 'entrada' ) => '13',
							__( '14', 'entrada' ) => '14',
							__( '15', 'entrada' ) => '15',
							__( '16', 'entrada' ) => '16',
							__( '17', 'entrada' ) => '17',
							__( '18', 'entrada' ) => '18',
							__( '19', 'entrada' ) => '19',
							__( '20', 'entrada' ) => '20',
							__( '21', 'entrada' ) => '21',
							__( '22', 'entrada' ) => '22',
							__( '23', 'entrada' ) => '23',
							__( '24', 'entrada' ) => '24'
						),
			'std' => '7',
			'description' => __( 'Select zoom level.', 'entrada' )
		),

		array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Width", "entrada" ),
            "param_name" => "entrada_gmap_width",
            "value" => __( "", "entrada" ),
            "description" => __( "Please enter map width.", "entrada" )
         ),	 		

		array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Height", "entrada" ),
            "param_name" => "entrada_gmap_height",
            "value" => __( "", "entrada" ),
            "description" => __( "Please enter map height.", "entrada" )
         )
      )

   ) );

   

 /*  Entrada VC : About Services Block 
---------------------------------------------------------- */

      vc_map( array(

      "name" => __( "Service Block", "entrada" ),
      "base" => "entrada_services_block",
	  'description'   => 'Shows services block.',
      "class" => "",	  
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(
         array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Title", "entrada" ),
				"param_name" => "entrada_service_block_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Add service title.", "entrada" )
         ),
		 
	
	 array(
            "type" 			 => "attach_image",
            "holder" 		 => "div",
            "class"		 	 => "",
            "heading"   	 => __( "Add Image", "entrada" ),
            "param_name"	 => "entrada_service_block_image",
            "value"     	 => __( "", "entrada" ),
            "description"	 => __( "Please add image here.", "entrada" )
         ),
	
		 array(	
				'type' => 'dropdown',
				'heading' => __( 'Icon', 'entrada' ),
				'param_name' => 'entrada_service_block_icon',
				'value' => $icon_array,
				'std' => 'roadmap',
				'description' => __( 'Select icon.', 'entrada' )
		),
	
	 array(
            "type" 			 => "textarea",
            "holder" 		 => "div",
            "class"		 	 => "",
            "heading"   	 => __( "Short Description", "entrada" ),
            "param_name"	 => "entrada_service_block_short_desc",
            "value"     	 => __( "", "entrada" ),
            "description"	 => __( "Please add short description here.", "entrada" )
         )

      )

   ) );

/*  Entrada VC Product Categories for Services
---------------------------------------------------------- */
      vc_map( array(

      "name" => __( "Service Category", "entrada" ),
      "base" => "cat_service",
	  'description'   => 'Category Listing from Tour Categories.',
      "class" => "",
	  "description" => "Shows multiple product category",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(

         array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Title", "entrada" ),
				"param_name" => "cat_service_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Description for category gallery.", "entrada" )
         ),

		  array(
				"type" => "checkbox",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Services", "entrada" ),
				"param_name" => "cat_service_lists",
				"value" => $product_cat_lists,
				"description" => __( "Please choose service category.", "entrada" )
         ),

		// Data settings

	array(
		'type' => 'dropdown',
		'heading' => __( 'Order by', 'entrada' ),
		'param_name' => 'cat_service_orderby',
		'value' => array(
			__( 'ID', 'entrada' ) => 'id',
			__( 'Name', 'entrada' ) => 'name',
			__( 'Slug', 'entrada' ) => 'slug',
		),
		'description' => __( 'Select order type.', 'entrada' ),
		'group' => __( 'Data Settings', 'entrada' ),
		'param_holder_class' => 'vc_grid-data-type-not-idsss',
	),	

	array(

		'type' => 'dropdown',
		'heading' => __( 'Sort order', 'entrada' ),
		'param_name' => 'cat_service_order',
		'group' => __( 'Data Settings', 'entrada' ),
		'value' => array(

			__( 'Descending', 'entrada' ) => 'desc',
			__( 'Ascending', 'entrada' ) => 'asc',

		),

		'param_holder_class' => 'vc_grid-data-type-not-idsss',
		'description' => __( 'Select sorting order.', 'entrada' )

	)

      )

   ) );
   
/*  Entrada VC Progress Bar
---------------------------------------------------------- */
 vc_map( array(
      "name" => __( "Progress Bar", "entrada" ),
      "base" => "entrada_progress_bar",
      "class" => "",
	  "description" => "Shows multiple progress bar",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(

         array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Title", "entrada" ),
				"param_name" => "progressbar_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Title for progress.", "entrada" )
         ),

	  array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Progress 1", "entrada" ),
				"param_name" => "progressbar1_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Add progress bar title and value (Example PEAK CLIMBING{{}}20). Value must be 0-100", "entrada" )
         ),
		 
	 array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Progress 2", "entrada" ),
				"param_name" => "progressbar2_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Add progress bar title and value (Example PEAK CLIMBING{{}}20). Value must be 0-100", "entrada" )
         ),
		 
	 array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Progress 3", "entrada" ),
				"param_name" => "progressbar3_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Add progress bar title and value (Example PEAK CLIMBING{{}}20). Value must be 0-100", "entrada" )
         ),
		 
	array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Progress 4", "entrada" ),
				"param_name" => "progressbar4_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Add progress bar title and value (Example PEAK CLIMBING{{}}20). Value must be 0-100", "entrada" )
         ),
		 
		 	array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Progress 5", "entrada" ),
				"param_name" => "progressbar5_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Add progress bar title and value (Example PEAK CLIMBING{{}}20). Value must be 0-100", "entrada" )
         ),


      )

   ) );
   
   
/*  Entrada VC Blockquote
---------------------------------------------------------- */
      vc_map( array(

      "name" => __( "Blockquote", "entrada" ),
      "base" => "entrada_blockquote",
      "class" => "",
	  "description" => "Shows blockquote block",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(

         array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Title", "entrada" ),
				"param_name" => "blockquote_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Title for blockquote.", "entrada" )
         ),
			
	     array(
				"type" 			 => "textarea",
				"holder" 		 => "div",
				"class"		 	 => "",
				"heading"   	 => __( "Blockquote Description", "entrada" ),
				"param_name"	 => "blockquote_short_desc",
				"value"     	 => __( "", "entrada" ),
				"description"	 => __( "Please add short description here.", "entrada" )
			 )	

      )

   ) );

/*  Entrada VC About Page :: Service Block
---------------------------------------------------------- */
      vc_map( array(

      "name" => __( "Featured Block", "entrada" ),
      "base" => "entrada_service_section",
      "class" => "",
	  "description" => "Shows featured block",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(

         array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Title", "entrada" ),
				"param_name" => "service_section_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Title for service block.", "entrada" )
         ),
			
	     array(
				"type" 			 => "textfield",
				"holder" 		 => "div",
				"class"		 	 => "",
				"heading"   	 => __( "No. of post to show", "entrada" ),
				"param_name"	 => "service_section_count",
				"value"     	 => __( "", "entrada" ),
				"description"	 => __( "Please add number of post to show.", "entrada" )
			 ),
			 
			 		// Data settings

	array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', 'entrada' ),
			'param_name' => 'orderby',
			'value' => array(
				__( 'Date', 'entrada' ) => 'date',
				__( 'Post ID', 'entrada' ) => 'ID',
				__( 'Title', 'entrada' ) => 'title',
				__( 'Last modified date', 'entrada' ) => 'modified',
		),

		'description' => __( 'Select order type.', 'entrada' ),
		'group' => __( 'Data Settings', 'entrada' ),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),

	),	

	array(

		'type' => 'dropdown',
		'heading' => __( 'Sort order', 'entrada' ),
		'param_name' => 'order',
		'group' => __( 'Data Settings', 'entrada' ),
		'value' => array(
			__( 'Descending', 'entrada' ) => 'DESC',
			__( 'Ascending', 'entrada' ) => 'ASC',
		),

		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'description' => __( 'Select sorting order.', 'entrada' ),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),

	),	

      )

   ) );

  /*  Entrada VC About Page :: Service Block
---------------------------------------------------------- */
    vc_map( array(

      "name" => __( "Product Carousel", "entrada" ),
      "base" => "entrada_product_carousel",
      "class" => "",
	  "description" => "Shows product listing on carousel",
	  "icon"  => plugins_url('/img/entrada_vc_extended_icon.png' , __FILE__ ),
      "category" => __( "Entrada Shortcodes", "entrada"),
      "params" => array(

         array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Title", "entrada" ),
				"param_name" => "product_carousel_title",
				"value" => __( "", "entrada" ),
				"description" => __( "Title for carousel block.", "entrada" )
         ),

        array(
				'type'        => 'autocomplete',
				'heading'     => __( 'Type a for products', 'entrada' ),
				'param_name'  => 'product_ids',
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
					'min_length' => 1,
					'no_hide' => true, // In UI after select doesn't hide an select list
					'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
					'display_inline' => false, // In UI show results inline view
					'values'   => $tour_listings,
				),
				'description' => __( 'Please type a for products', 'entrada' ),
				), 
			
	    array(
				"type" 			 => "textfield",
				"holder" 		 => "div",
				"class"		 	 => "",
				"heading"   	 => __( "Total product to show", "entrada" ),
				"param_name"	 => "product_carousel_count",
				"value"     	 => __( "9", "entrada" ),
				"description"	 => __( "Please add number of post to show.", "entrada" )
			),

	    array(
			'type' => 'dropdown',
			'heading' => __( 'Carousel Display Option', 'entrada' ),
			'param_name' => 'carousel_display_opt',
			'value' => array(
				__( 'Default Layout', 'entrada' ) => 'default_display',
				__( 'Featured Layout', 'entrada' ) => 'featured_display',
				)
			),
	    array(
			'type' => 'dropdown',
			'heading' => __( 'Auto Play Option', 'entrada' ),
			'param_name' => 'auto_play',
			'value' => array(
				__( 'False', 'entrada' ) => 'false',
				__( 'True', 'entrada' ) => 'true',
			)
		),
		array(
				"type" 			 => "textfield",
				"holder" 		 => "div",
				"class"		 	 => "",
				"heading"   	 => __( "slide Speed", "entrada" ),
				"param_name"	 => "slide_speed",
				"value"     	 => __( "300", "entrada" ),
				"description"	 => __( "Add slide speed in miliseconds.", "entrada" ),
			),	
			 
			 		// Data settings

	array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', 'entrada' ),
			'param_name' => 'orderby',
			'value' => array(
				__( 'Date', 'entrada' ) => 'date',
				__( 'Post ID', 'entrada' ) => 'ID',
				__( 'Title', 'entrada' ) => 'title',
				__( 'Last modified date', 'entrada' ) => 'modified',
				__( 'Popular', 'entrada' ) => 'popular_tour',
				__( 'Featured', 'entrada' ) => 'featured_tour',
		),

		'description' => __( 'Select order type.', 'entrada' ),
		'group' => __( 'Data Settings', 'entrada' ),
		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),

	),	

	array(

		'type' => 'dropdown',
		'heading' => __( 'Sort order', 'entrada' ),
		'param_name' => 'order',
		'group' => __( 'Data Settings', 'entrada' ),
		'value' => array(
			__( 'Descending', 'entrada' ) => 'DESC',
			__( 'Ascending', 'entrada' ) => 'ASC',
		),

		'param_holder_class' => 'vc_grid-data-type-not-ids',
		'description' => __( 'Select sorting order.', 'entrada' ),
		'dependency' => array(
			'element' => 'post_type',
			'value_not_equal_to' => array( 'ids', 'custom' ),
		),

	),	

      )

   ) );    

}

?>