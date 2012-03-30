<?php

$objKpax = new kpaxSrv(elgg_get_logged_in_user_entity()->username);
gatekeeper();
// get the form input
$title = get_input('title');
$description = get_input('description');
$tags = string_to_tag_array(get_input('tags'));

$guid = get_input('guid');


$container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());

elgg_make_sticky_form('kpax');


if ($guid == 0) {
    $kpaxPost = new ElggObject;
    $kpaxPost->subtype = "kpax";
    $kpaxPost->container_guid = (int) get_input('container_guid', $_SESSION['user']->getGUID());
    $new = true;
} else {
    $kpaxPost = get_entity($guid);
    if (!$kpaxPost->canEdit()) {
        system_message(elgg_echo('kpax:save:failed:entity'));
        forward(REFERRER);
    }
}
// create a new blog object

$kpaxPost->title = $title;
$kpaxPost->description = $description;



// for now make all blog posts public
$kpaxPost->access_id = ACCESS_LOGGED_IN;

// owner is logged in user
$kpaxPost->owner_guid = elgg_get_logged_in_user_guid();

// save tags as metadata
$kpaxPost->tags = $tags;



// save to database
if ($kpaxPost->save()) {
    
    elgg_clear_sticky_form('kpax');
    system_message(elgg_echo('kpax:save:success'));
} else {
    register_error(elgg_echo('kpax:save:failed'));
    forward("kpax");
}

if($objKpax->addGame($_SESSION["campusSession"],$title, $kpaxPost->getGUID())!="OK"){
 register_error(elgg_echo('kpax:save:failed:service'));
}

// forward user to a page that displays the post
forward($kpaxPost->getURL());
?>