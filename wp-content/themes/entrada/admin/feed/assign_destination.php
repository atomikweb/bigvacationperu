<?php

add_action( 'admin_init', 'entrada_check_destination_hierarchy' );
function entrada_check_destination_hierarchy(){
	$cnt = 0;
	$diestinations = get_terms('destination', array('hide_empty' => 0, 'orderby' => 'name', 'order' => 'asc'));
	if ( isset( $diestinations ) ) {
		foreach($diestinations as $dest){
			$cnt++;
			if(isset($dest->parent) && $dest->parent != 0) {
				entrada_assign_destination_parent($dest->term_id, $dest->name, $dest->parent);
			}
		}
	}
}

function entrada_assign_destination_parent($t_id, $t_name, $parent){
	$term = get_term_by('id', $parent, 'destination');

	if(!isset($term->term_id)){
		$africa = get_term_by('name', 'Africa', 'destination');
		$asia = get_term_by('name', 'Asia', 'destination');
		$world = get_term_by('name', 'World', 'destination');
		$europe = get_term_by('name', 'Europe', 'destination');
		$new_parent_id = 0;
		switch ($t_name) {

			case 'Ethiopia':
				$new_parent_id =  $africa->term_id;
			break;

			case 'France':
				$new_parent_id = $europe->term_id;
			break;

			case 'Germany':
				$new_parent_id = $europe->term_id;
			break;

			case 'Greece':
				$new_parent_id = $europe->term_id;
			break;

			case 'Italy':
				$new_parent_id = $europe->term_id;
			break;

			case 'Netherlands':
				$new_parent_id = $africa->term_id;
			break;

			case 'Spain':
				$new_parent_id = $europe->term_id;
			break;

			case 'Tanzania':
				$new_parent_id = $africa->term_id;
			break;

			case 'United Kingdom':
				$new_parent_id = $europe->term_id;
			break;

			/* Already seems asigned ...... */
			case 'Australia':
				$new_parent_id = $world->term_id;
			break;

			case 'Canada':
				$new_parent_id = $world->term_id;
			break;

			case 'China':
				$new_parent_id = $asia->term_id;
			break;

			case 'India':
				$new_parent_id = $asia->term_id;
			break;

			case 'Nepal':
				$new_parent_id = $asia->term_id;
			break;

			case 'New Zealand':
				$new_parent_id = $world->term_id;
			break;

			case 'North America':
				$new_parent_id = $world->term_id;
			break;

			case 'Turkey':
				$new_parent_id = $world->term_id;
			break;

			default:

				/* do nothing */
		}
		wp_update_term($t_id, 'destination', array( 'parent' => $new_parent_id, ));
	}

}
