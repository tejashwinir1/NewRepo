<?php
// //program  - ONETIME FOR tbl_user_certificates 
include "db.php";
 
$select_sql = ' select user_id, group_concat(class_id) as class_ids from tbl_user_certificates where program_status = 0 and type = 1 '; //  completed course certs
$data 		= $con->query($select_sql);

if($data->num_rows > 0){
    while($row = mysqli_fetch_assoc($data)) {
        // var_dump($row);exit;
        $user_id 		            =	$row['user_id'];
		$completed_class_ids 		=	$row['class_ids'];
        $completed_class_ids_arr    =   explode(",",$completed_class_ids);
        $date_today 		        =	date('Y-m-d', strtotime("-1 days"));
		$type 		                =	2;
      
        $track_sql          = " select prog_id,course_set from tbl_track_programs where user_id = $user_id  ";
        $track_class_ids 	= $con->query($track_sql);
        
        if($track_class_ids->num_rows > 0){
           
            while($row = mysqli_fetch_assoc($track_class_ids)) {
                
                $program_id             =	$row['prog_id'];
                $track_course_set       =	$row['course_set'];
                $track_course_set_arr   = explode(",",$track_course_set);
                
                $containsSearch = array_diff($track_course_set_arr, $completed_class_ids_arr) ;

                if( empty($containsSearch) ){
                    $insert_sql = "insert into tbl_user_certificates (user_id,program_id,type,created_date,updated_date) values ('$user_id','$program_id',$type,'$date_today','$date_today') ";
                    $result     = mysqli_query($con, $insert_sql) or die("Selection Error " . mysqli_error($con));

                    $update_sql = "update tbl_user_certificates set program_status = 1 where class_id in ($track_course_set) and user_id = $user_id";
                    $result1     = mysqli_query($con, $update_sql) or die("Selection Error " . mysqli_error($con));
                }
            }
        }    
	}
}

// close the db connection
mysqli_close($con);
// ============================================
//course  - ONETIME FOR tbl_user_certificates - courses
// include "db.php";

// $select_sql = 'select user_id,course_id from tbl_points where (scorm_point>=0 or is_ia_not_exists=1) and course_completion_point>0 and (project_point>0 or is_project_not_exists=1) group by user_id,course_id';
// $data 		= $con->query($select_sql);

// if($data->num_rows > 0){
// 	while($row = mysqli_fetch_assoc($data)) {
//         // var_dump($row); exit;
// 		$user_id 		            =	$row['user_id'];
// 		$course_id 		            =	$row['course_id'];
// 		$date_today 		        =	date('Y-m-d');
// 		$type 		                =	1;

//         $insert_sql = "insert into tbl_user_certificates (user_id,class_id,type,created_date,updated_date) values ('$user_id','$course_id',$type,'$date_today','$date_today') ";
//         $result = mysqli_query($con, $insert_sql) or die("Selection Error " . mysqli_error($con));
// 	}
// }

// // close the db connection
// mysqli_close($con);
// -----------------------------------------

// course  - ONETIME FOR tbl_points (is_project_not_exists, is_ia_not_exists) 
// include "db.php";

// $select_sql = 'select distinct(course_id) from tbl_points ';
// $data 		= $con->query($select_sql);

// $ia = 1;
// $pdf = 1;
// if($data->num_rows > 0){
// 	while($row = mysqli_fetch_assoc($data)) {
//         $ia = 1;
//         $pdf = 1;
// 		$course_id 		=	$row['course_id'];
//         $lesson_sql     = "select lesson_type from lessons where class_id = $course_id and lesson_type in ('ia','project_pdf') and lesson_status = 1";
//         $lesson_type 	= $con->query($lesson_sql);
        
//         if($lesson_type->num_rows > 0){
//             while($row = mysqli_fetch_assoc($lesson_type)) {
//                 $lesson_arr = array();

//                 foreach($lesson_type as $key => $value){
//                     $lesson_arr[] = $value['lesson_type'];
//                 }
//             }
            
//             if(in_array("ia",$lesson_arr)){
//                 $ia = 0;
//             }
//             if(in_array("project_pdf",$lesson_arr)){
//                 $pdf = 0;
//             }
//         }
        
//         $update_sql  = "update tbl_points set is_project_not_exists=$pdf , is_ia_not_exists=$ia where course_id = $course_id"; 
//         $result = mysqli_query($con, $update_sql) or die("Selection Error " . mysqli_error($con));
// 	}
// }

// // close the db connection
// mysqli_close($con);
// ===========================================================
// // course - ia - tbl_track_user_activity - namitha 7/11/2023
// include "db.php";
// $select_sql = " select user_id,class_id,watch_complete_date from tbl_track_user_activity where watch_complete_date <='2023-08-31' and is_watched=1 and ia_done=0 ";
// $data 		= $con->query($select_sql);
// // echo "eher"; exit;
//     if($data->num_rows > 0){
//         while($row = mysqli_fetch_assoc($data)) {
//             $user_id 		        =	$row['user_id'];
//             $class_id 		        =	$row['class_id'];
//             $watch_complete_date 	=	$row['watch_complete_date'];
//             $select_ia_sql          = "select is_ia_not_exists from tbl_points where user_id='$user_id' and course_id='$class_id' and is_ia_not_exists=0";
//             $select_ia 		        = $con->query($select_ia_sql);
//             // var_dump($select_ia->num_rows);
// 		        if($select_ia->num_rows > 0){
// 			        // $ia 	= mysqli_fetch_row($select_ia);
//                     $update_sql = "update tbl_track_user_activity set ia_complete_date='$watch_complete_date',ia_done=1 where user_id='$user_id' and class_id='$class_id'";
//                     $result = mysqli_query($con, $update_sql) or die("Selection Error " . mysqli_error($con));
//                 }
//         }
//     }

// // close the db connection
// mysqli_close($con);
// =============================================