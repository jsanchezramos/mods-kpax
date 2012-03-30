<?php


$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);
?>


<div>
    <label><?php echo elgg_echo("title"); ?></label><br />
    <?php echo elgg_view('input/text', array('internalname' => 'title', 'value' => $title)); ?>
</div>

<div>
    <label><?php echo elgg_echo("description"); ?></label><br />
    <?php echo elgg_view('input/longtext', array('internalname' => 'description', 'value' => $desc)); ?>
</div>


<div>
    <label><?php echo elgg_echo("tags"); ?></label><br />
    <?php echo elgg_view('input/tags', array('internalname' => 'tags', 'value' => $tags)); ?>
</div>

<?php


echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
}

?>
<div>
    <?php echo elgg_view('input/submit', array('value' => elgg_echo('save'))); ?>
</div>
