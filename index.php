<?php
require_once 'DB.php';
$data = [
        'username' => 'king',
        'password' => 'arthur002'
    ];
DB::deleteRecord('users');
//$res = DB::fetchAllRecords('users');
//var_dump($res);
//session_start();
//if (isset($_POST['submit']))
//{
//    $uname = $_POST['username'];
//    $pwd = $_POST['password'];
//
//    $data = [
//        'username' => $uname,
//        'password' => $pwd
//    ];
//
//    if (DB::insertRecord('users', $data))
//    {
//        $_SESSION['response'] = 'Data Entry Successful :)';
//    }
//    else
//    {
//        $_SESSION['response'] = 'Data Entry Unsuccessful :(';
//    }
//}

