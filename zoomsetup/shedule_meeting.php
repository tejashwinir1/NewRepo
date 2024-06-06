<?php 
include('db.php');
error_reporting('E_ALL');
require_once 'Zoom/Index.php';
use Zoom\Meeting;
$meeting = new Meeting();


$query = 'SELECT * FROM live_class WHERE shdedule_status =0 ORDER BY id desc';
$result = mysqli_query($con,$query);
$shedule = mysqli_fetch_object($result);
if($shedule){


//exit;
$date = $shedule->live_date;
$time = strtotime($date);
$time = $time - (330 * 60);
$date = date("Y-m-d H:i:s", $time);
$date = $date.'Z';

$data = [
	'topic' => $shedule->live_title,
	'agenda' => 'Live ',
	'start_time' => $date,
	'settings' => [
		'host_video' => false,
		'participant_video' => true,
		'join_before_host' => true,
		'audio' => true,
		'approval_type' => 2,
		'waiting_room' => false,
	],
];
print_r($data);
$meeting = $meeting->create($data);

if(count($meeting) > 0){
	$query = "UPDATE live_class SET zoom_meeting_id = '".$meeting['id']."',zoom_meeting_password='".$meeting['password']."',host_url = '".$meeting['start_url']."',par_url = '".$meeting['join_url']."',shdedule_status=1 where id=".$shedule->id;
	mysqli_query($con,$query);
}
print_r($meeting);
}
exit;
