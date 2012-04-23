<?php
/**
 * Elgg delete like action
 *
 */
$objKpax = new kpaxSrv(elgg_get_logged_in_user_entity()->username);
$user = elgg_get_logged_in_user_entity();
$kpaxPost = get_entity(get_input('guid'));

if($kpaxPost->getSubtype() == "kpax")$objKpax->delLikeGame($_SESSION["campusSession"],$user->guid,(int) get_input('guid'));

$likes = elgg_get_annotations(array(
	'guid' => (int) get_input('guid'),
	'annotation_owner_guid' => elgg_get_logged_in_user_guid(),
	'annotation_name' => 'likes',
));
if ($likes) {
	if ($likes[0]->canEdit()) {
		$likes[0]->delete();
		system_message(elgg_echo("likes:deleted"));
		forward(REFERER);
	}
}

register_error(elgg_echo("likes:notdeleted"));
forward(REFERER);
