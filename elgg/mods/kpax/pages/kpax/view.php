<?php

/**
 * View a bookmark
 *
 * @package ElggBookmarks
 */
$kpax = get_entity(get_input('guid'));


$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;


$title = $kpax->title;

elgg_push_breadcrumb($title);

$content = elgg_view_entity($kpax, array('full_view' => true));
$content .= elgg_view_comments($kpax);

$body = elgg_view_layout('content', array(
    'content' => $content,
    'title' => $title,
    'filter' => '',
    'header' => '',
        ));

echo elgg_view_page($title, $body);