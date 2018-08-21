<?php

namespace Kntnt\Taxonomy_Mapper;

class Mapper {

	private $map;

	public function run() {
		$this->map = Plugin::option( 'map', [] );
		add_action( 'added_term_relationship', [ $this, 'added_term_relationship' ], 10, 3 );
	}

	// Adds to the post with the id $post_id all terms that belongs to a
	// taxonomy to which there is a mapping from the added term with id
	// $add_term_id. The term belongs to the taxonomy with the slug
	// $add_taxonomy_slug.
	public function added_term_relationship( $post_id, $add_term_id, $add_taxonomy_slug ) {

		// Nothing to do if the added terms belongs to a taxonomy for which
		// there is no mapping.
		if ( ! key_exists( $add_taxonomy_slug, $this->map ) ) {
			return;
		}

		// Get the added term's slug.
		$add_term_slug = get_term_by( 'id', $add_term_id, $add_taxonomy_slug )->slug;

		// Nothing to do if there is no mapping from the added term.
		if ( ! key_exists( $add_term_slug, $this->map[ $add_taxonomy_slug ] ) ) {
			return;
		}

		// Get all destination taxonomies for which terms should be added.
		$map_taxonomy_slugs = array_keys( $this->map[ $add_taxonomy_slug ][ $add_term_slug ] );

		// For each destination taxonomy...
		foreach ( $map_taxonomy_slugs as $map_taxonomy_slug ) {

			// Get the terms mapped to.
			$map_terms_slug = $this->map[ $add_taxonomy_slug ][ $add_term_slug ][ $map_taxonomy_slug ];

			// Replace current terms with the terms mapped to.
			// $append == false so the mapping replaces the old terms.
			wp_set_post_terms( $post_id, $map_terms_slug, $map_taxonomy_slug, false );

		}

	}

}