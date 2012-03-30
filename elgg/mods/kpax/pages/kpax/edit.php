<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$kpax_guid = get_input('guid');
$kpax = get_entity($kpax_guid);

if (!elgg_instanceof($kpax, 'object', 'kpax') || !$kpax->canEdit()) {
    register_error(elgg_echo('kpax:unknown_kpax'));
    forward(REFERRER);
}

$page_owner = elgg_get_page_owner_entity();

$title = elgg_echo('kpax:edit');
elgg_push_breadcrumb($title);

$vars = kpax_prepare_form_vars($kpax);
$content = elgg_view_form('kpax/save', array(), $vars);

$body = elgg_view_layout('content', array(
    'filter' => '',
    'content' => $content,
    'title' => $title,
        ));

echo elgg_view_page($title, $body);
?>
