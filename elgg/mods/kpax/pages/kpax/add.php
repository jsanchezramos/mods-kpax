<?php

//// Load Elgg engine
//include_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
//
//// make sure only logged in users can see this page	
//gatekeeper();
//
//// set the title
//$title = "Create new game";
//
//// start building the main column of the page
//$area2 = elgg_view_title($title);
//
//// Add the form to this section
//$area2 .= elgg_view_form("kpax/save");
//
//// layout the page
//$body = elgg_view_layout('two_column_left_sidebar', '', $area2);
//
//// draw the page
//echo elgg_view_page($title, $body);



$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('kpax:add');
elgg_push_breadcrumb($title);

$vars = kpax_prepare_form_vars();
$content = elgg_view_form('kpax/save', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);
?>
