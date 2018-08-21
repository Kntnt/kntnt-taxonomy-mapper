<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt's Taxonomy Mapper
 * Plugin URI:        https://github.com/Kntnt/kntnt-taxonomy-mapper
 * Description:       Maps terms of a taxonomy to terms of other taxonomies.
 * Version:           1.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       kntnt-taxonomy-mapper
 * Domain Path:       /languages
 */

namespace Kntnt\Taxonomy_Mapper;

defined( 'WPINC' ) || die;

require_once __DIR__ . '/classes/class-plugin.php';

new Plugin( [
	//'index' => [  ],
	'admin' => [ 'Settings', 'Mapper' ],
] );
