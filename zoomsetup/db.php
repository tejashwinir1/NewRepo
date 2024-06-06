<?php
$db = array();
// $db['hostname'] = 'localhost';
// $db['username'] = 'root';
// $db['password'] = 'Vishnu99%';
// $db['database'] = 'clapmasterdemo';

$db['hostname'] = 'ulipsutest.cfw55oxjmntd.ap-south-1.rds.amazonaws.com';
$db['username'] = 'ulipsu_test';
$db['password'] = 'ulipsu_test99';
$db['database'] = 'clapmasterdemo';
$con = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database'])
					or die ('Could not connect to the database server' . mysqli_connect_error());
