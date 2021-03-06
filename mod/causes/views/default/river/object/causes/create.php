<?php
/**
 * New causes river entry
 *
 * @package Causes
 */

$object = $vars['item']->getObjectEntity();
$excerpt =elgg_get_excerpt($object->description,200);


$subject = $vars['item']->getSubjectEntity();
$subject_link = elgg_view('output/url', array(
	'href' => $subject->getURL(),
	'text' => $subject->name,
	'class' => 'elgg-river-subject',
	'is_trusted' => true,
));
$title = elgg_get_friendly_title($object->title);
$object_link = elgg_view('output/url', array(
	'href' => "causes/view/{$object->guid}/{$title}",
	'text' => elgg_echo('causes:reviews'),
	'class' => 'elgg-river-object',
	'is_trusted' => true,
));

$summary = elgg_echo("river:create:object:causes", array($subject_link, $object_link));

echo elgg_view('river/elements/layout', array(
	'item' => $vars['item'],
	'message' => $excerpt,
	'summary' => $summary,
));
