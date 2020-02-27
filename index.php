<?php

require_once 'DBActions.php';
$col = ['id', 'username'];
//$data = DBActions::reduceColumns($col);
//$data = DBActions::fetchAllRecords('users', 1);
//echo '<pre>';
//print_r($data);
//echo '</pre>';
$res = DBActions::fetchSingleRecordFromSpecificColumnsByID('users', $col, 1);
echo '<pre>';
var_dump($res);
echo '</pre>';
