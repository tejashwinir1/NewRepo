<?php 
require_once 'Zoom/Index.php';
use Zoom\Meeting;
$meeting = new Meeting();
//create a data meeting
$data = [
	'topic' => 'A new zoom meeting',
	'agenda' => 'our meeting desc',
	'settings' => [
		'host_video' => false,
		'participant_video' => true,
		'join_before_host' => true,
		'audio' => true,
		'approval_type' => 2,
		'waiting_room' => false,
	],
];
$meeting = $meeting->create($data);
echo '<pre>';
print_r($meeting);
exit;

?>