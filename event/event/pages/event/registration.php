<?php
$eventid = (int) get_input('eventid');
$event = get_entity($eventid);
$event_metadata = get_events("guid=$eventid");
elgg_set_page_owner_guid($event->owner_guid);

if (!elgg_instanceof($event, 'object', 'event') || !$event->canEdit()) {
	register_error(elgg_echo('event:unknown_event'));
	forward(REFERRER);
}


if($event){
	event_sidebar_navigation($event);
	elgg_push_breadcrumb($event->title, 'event/view/'.$event->guid.'/'.elgg_get_friendly_title($event->title));
	$content = elgg_view('event/registration', array('event' => $event));
}else{
	$content = elgg_echo('event:noevent');
}

$title = elgg_echo('event:registration');

$sidebar = elgg_view('event/sidebar/sidebar', array('entity' => $event,'event_metadata'=>$event_metadata));

$body = elgg_view_layout('content', array(
	'filter_override' => elgg_view('event/filter_tab_edit',array('selected'=>'registration','event' => $event)),
	'filter_context' => 'all',
	'sidebar' => $sidebar,
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);