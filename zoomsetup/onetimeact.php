<?php
include "db.php";

$select_sql = "select user_id,class_id from tbl_track_user_activity limit 10";
$track 		= $con->query($select_sql);

if($track->num_rows > 0){
	while($row = mysqli_fetch_assoc($track)) {
		$user_id 	=	$row['user_id'];
		$class_id 	=	$row['class_id'];
		$track_pro_sql 	= "select prog_id from tbl_track_programs where user_id = $user_id and  FIND_IN_SET($class_id,course_set)";
		$track_pro 		= $con->query($track_pro_sql);
		
		if($track->num_rows > 0){
			$pro 	= mysqli_fetch_row($track_pro);
			$pro_id = $pro['prog_id'];

			$sql = "update tbl_track_user_activity set program_id = $pro_id";
	   		$result = mysqli_query($con, $sql) or die("Selection Error " . mysqli_error($con));
		}
	}
}

//close the db connection
mysqli_close($con);

// ----------------------
// include "db.php";

// $select_sql = "select distinct(user_id) from tbl_points";
// $result1 	= $con->query($select_sql);

// if($result1->num_rows > 0){
// 	while($row = mysqli_fetch_assoc($result1)) {
// 		$user_id =	$row['user_id'];
// 		$sql = "update user set points = (select sum(scorm_point+course_completion_point+project_point) from tbl_points where user_id='$user_id') where user_id='$user_id';";
// 	   $result = mysqli_query($con, $sql) or die("Selection Error " . mysqli_error($con));
// 	}
// }

// //close the db connection
// mysqli_close($con);


// -------------
// include "db.php";
//$user_ids = array(8356,11812,14504,14504,9479,9327,9414,12123,10610,16005,8612,8363,8302,8291,8356,8355,8333,8571,8407,8490,8498,8582,8567,8332,8330,8319,8316,8501,8493,8502,8508,8492,8315,8526,8489,8486,8522,8537,8518,8487,8509,8316,8330,8377,8372,8400,8414,8208,8393,8373,17713,17719,9449,9457,9393,16295,9438,9477,9364,9484,9403,11645,11636,11655,15849,15840,15833,15871,15870,15882,15874,15869,15865,15889,15867,15894,15880,15864,15881,15878,15890,15866,20568,8225,8200,24964,10465,12141,24964,25970);

// $user_ids = array(1,261,6241,7752,2566,8627,2116,11286,11289,11288,11367,11308,8556,8546,8547,8569,8550,8563,8561,8597,8607,8585,8604,8566,8436,8452,8469,8444,8433,8503,8900,8589,8565,8592,8609,8577,8572,8902,8497,8540,8491,8512,8496,8441,8451,8466,8445,8467,8472,8437,8344,8357,8360,8346,8359,8304,8279,8351,8345,8510,8519,14504,8584,12148,9382,9320,10610,8542,17732,17709,9385,9393,10651,17826,17724,17712,17728,17711,17718,17727,17725,17726,17683,17692,17699,10297,25930,11448,26569,18108,17823,11818,28368,19654,19689,19686,19904,19810); // points mismatch in user and tbl_points - namitha

// foreach ($user_ids as $key => $user_id) {

// 	$sql = "update user set points=(select sum(scorm_point+course_completion_point+project_point) from tbl_points where user_id='$user_id') where user_id='$user_id';";
// 	    $result = mysqli_query($con, $sql) or die("Selection Error " . mysqli_error($con));
// }

// //close the db connection
// mysqli_close($con);


?>

