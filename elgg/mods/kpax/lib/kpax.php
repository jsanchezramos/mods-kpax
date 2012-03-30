<?php
/**
 * kpax helper functions
 *
 * @package kpax
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $kpax A kpax object.
 * @return array
 */
function kpax_prepare_form_vars($kpax = null) {
	// input names => defaults
	$values = array(
		'title' => get_input('title', ''), // bookmarklet support
		'description' => get_input('description', ''),
		'access_id' => ACCESS_LOGGED_IN,
		'tags' => '',
		'shares' => array(),
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $kpax,
	);

	if ($kpax) {
		foreach (array_keys($values) as $field) {
			if (isset($kpax->$field)) {
				$values[$field] = $kpax->$field;
			}
		}
	}

	if (elgg_is_sticky_form('kpax')) {
		$sticky_values = elgg_get_sticky_values('kpax');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('kpax');

	return $values;
}
