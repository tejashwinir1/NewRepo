<?php 
include('db.php');
require_once 'Zoom/Index.php';
use Zoom\Meeting;
$meeting 		= new Meeting();

$date 			= date("Y-m-d");
$query 			= 'SELECT id, zoom_meeting_id FROM `live_class` WHERE shdedule_status = 1 AND `scheduled_date` =  "'. $date. '" ORDER BY id desc';
$result_query 	= mysqli_query($con,$query);
$result			= $result_query->fetch_all(MYSQLI_ASSOC);
$meeting_id 	= 0;
$account_id 	= 0;

if($result)
{
	foreach ($result as $key => $value )
	{
		$meeting_id 	= $value['zoom_meeting_id'];
		$account_id		= $value['id'];
		if($meeting_id)
		{
			$meeting_data 	= $meeting->url_download($meeting_id);
			$play_url 		= $meeting_data['recording_files'][0]['play_url'];
			$download_url 	= $meeting_data['recording_files'][0]['download_url'];
			$password 		= $meeting_data['password'];
			
			if($meeting_data['recording_files'])
			{
				$up_query = "UPDATE live_class SET 
							zoom_download_url = '".$download_url."',
							zoom_play_url = '".$play_url."',
							zoom_passcode_play_url ='".$password."'
							where id=".$account_id;
				mysqli_query($con,$up_query);
			}
		}
	}
}

echo "Cron completed";
exit();