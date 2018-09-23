<?php

namespace Kntnt\Taxonomy_Mapper;

require_once __DIR__ . '/class-abstract-settings.php';

class Settings extends Abstract_Settings {

	/**
	 * Returns the settings menu title.
	 */
	protected function menu_title() {
		return __( 'Taxonomy Mapper', 'kntnt-taxonomy-mapper' );
	}

	/**
	 * Returns the settings page title.
	 */
	protected function page_title() {
		return __( 'Kntnt\'s Taxonomy Mapper', 'kntnt-taxonomy-mapper' );
	}

	/**
	 * Returns all fields used on the settings page.
	 */
	protected function fields() {

		$fields['map'] = [
			'type' => 'text area',
			'rows' => 25,
			'cols' => 80,
			'label' => __( 'Taxonomy map', 'kntnt-taxonomy-mapper' ),
			'description' => __( 'Enter a JSON object which consists of key/value-pairs where each key is the name of a source taxonomy and each value is another JSON object, which consists of key/value-pairs where each key is the name of a term in the source taxonomy and each value is another JSON object, which consists of key/value-pairs where each key is the name of a destination taxonomy and each value is a JSON array, which consists of the names of terms in the destination taxonomy. This describes a relationship from terms in the source taxonomies to terms in the destination taxonomies. Every time a specified term in the source taxonomy is added to or deleted from a post, the mapped taxonomies will be updated accordingly to the map. The same taxonomy must not be used both as source and destination as that can result in an infinite loop.', 'kntnt-taxonomy-mapper' ),
			'filter-before' => [ $this, 'filter_before' ],
			'filter-after' => [ $this, 'filter_after' ],
		];

		return $fields;

	}

	public function filter_before( $value ) {
		return json_encode( $value, JSON_PRETTY_PRINT | JSON_PARTIAL_OUTPUT_ON_ERROR );
	}

	public function filter_after( $value ) {
		return json_decode( stripslashes( $value ), true );
	}

}
