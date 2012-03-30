<?php

$title = elgg_echo('kpax:all');

elgg_register_title_button();

$content = elgg_list_entities(array(
    'types' => 'object',
    'subtypes' => 'kpax',
    'limit' => 10,
    'full_view' => false,
        ));
if (!$content) {
    $content = '<p>' . elgg_echo('kpax:none') . '</p>';
}

$body = elgg_view_layout('content', array(
    'filter_context' => 'all',
    'content' => $content,
    'title' => $title,
    'sidebar' => elgg_view('kpax/sidebar'),
        ));

echo elgg_view_page($title, $body);



?>
