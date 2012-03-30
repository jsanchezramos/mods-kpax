<?php

/**
 * View for blog objects
 *
 * @package Blog
 */
$full = elgg_extract('full_view', $vars, FALSE);
$kpax = elgg_extract('entity', $vars, FALSE);

if (!$kpax) {
    return TRUE;
}

$owner = $kpax->getOwnerEntity();
$container = $kpax->getContainerEntity();
$categories = elgg_view('output/categories', $vars);
$excerpt = $kpax->excerpt;

$owner_icon = elgg_view_entity_icon($owner, 'tiny');
$owner_link = elgg_view('output/url', array(
    'href' => "kpax/owner/$owner->username",
    'text' => $owner->name,
        ));
$author_text = elgg_echo('byline', array($owner_link));
$tags = elgg_view('output/tags', array('tags' => $kpax->tags));
$date = elgg_view_friendly_time($kpax->time_created);

// The "on" status changes for comments, so best to check for !Off
if ($kpax->comments_on != 'Off') {
    $comments_count = $kpax->countComments();
    //only display if there are commments
    if ($comments_count != 0) {
        $text = elgg_echo("comments") . " ($comments_count)";
        $comments_link = elgg_view('output/url', array(
            'href' => $kpax->getURL() . '#kpax-comments',
            'text' => $text,
                ));
    } else {
        $comments_link = '';
    }
} else {
    $comments_link = '';
}




$metadata = elgg_view_menu('entity', array(
    'entity' => $vars['entity'],
    'handler' => 'kpax',
    'sort_by' => 'priority',
    'class' => 'elgg-menu-hz',
        ));

$subtitle = "<p>$author_text $date $comments_link</p>";
$subtitle .= $categories;

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
    $metadata = '';
}

if ($full) {
    $title = false;

    $contentFooter = "";
    $objKpax = new kpaxSrv(elgg_get_logged_in_user_entity()->username);
    $objGame = $objKpax->getGame($kpax->guid, $_SESSION["campusSession"]);
    if (intval($owner->guid) == intval(elgg_get_logged_in_user_entity()->guid)) {
        $contentFooter .= "Game id: " . $objGame->secretGame;
    }


    $objScore = $objKpax->getScore($objGame->secretGame);


    $body = elgg_view('output/longtext', array(
        'value' => $kpax->description . '<br>' . $contentFooter,
        'class' => 'kpax-post',
            ));

    $header = elgg_view_title($kpax->title);

    $params = array(
        'entity' => $kpax,
        'title' => $title,
        'metadata' => $metadata,
        'subtitle' => $subtitle,
        'tags' => $tags,
    );
    $params = $params + $vars;


    $list_body = elgg_view('object/elements/summary', $params);

    $paramsScore = array(
        'score' => $objScore,
    );

    $scoreHTML = elgg_view('kpax/score', array('objScore' => $objScore));

    $blog_info = elgg_view_image_block($owner_icon, $list_body);

    echo <<<HTML
$header
$blog_info
$body
$scoreHTML
HTML;
} else {
    // brief view

    $params = array(
        'entity' => $kpax,
        'metadata' => $metadata,
        'subtitle' => $subtitle,
        'tags' => $tags,
        'content' => $excerpt,
    );
    $params = $params + $vars;
    $list_body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($owner_icon, $list_body);
}