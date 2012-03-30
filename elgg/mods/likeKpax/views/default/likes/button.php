<?php
/**
 * Elgg likes button
 *
 * @uses $vars['entity']
 */


$objKpax = new kpaxSrv(elgg_get_logged_in_user_entity()->username);
if (!isset($vars['entity'])) {
	return true;
}


// Realizamos la consulta por servicio
$guid = $vars['entity']->getGUID();

$objKpaxLike = $objKpax->getLikeGame($_SESSION["campusSession"], $guid);

if ($objKpaxLike->containerId == 0 && $objKpaxLike!=null) {
    $user = elgg_get_logged_in_user_entity();
    $objKpax->addLikeGame($_SESSION["campusSession"],$user->guid,$guid);
    create_annotation($guid, 'likes', "likes", "", $user->guid, $vars['entity']->access_id);
}

// check to see if the user has already liked this
if (elgg_is_logged_in() && $vars['entity']->canAnnotate(0, 'likes')) {
	if (!elgg_annotation_exists($guid, 'likes')) {
		$url = elgg_get_site_url() . "action/likeKpax/add?guid={$guid}";
		$params = array(
			'href' => $url,
			'text' => elgg_view_icon('thumbs-up'),
			'title' => elgg_echo('likes:likethis'),
			'is_action' => true,
		);
		$likes_button = elgg_view('output/url', $params);
	} else {
		$options = array(
			'guid' => $guid,
			'annotation_name' => 'likes',
			'owner_guid' => elgg_get_logged_in_user_guid()
		);
		$url = elgg_get_site_url() . "action/likeKpax/delete?guid={$guid}";
		$params = array(
			'href' => $url,
			'text' => elgg_view_icon('thumbs-up-alt'),
			'title' => elgg_echo('likes:remove'),
			'is_action' => true,
		);
		$likes_button = elgg_view('output/url', $params);
	}
}

echo $likes_button;
