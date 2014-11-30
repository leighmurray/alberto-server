<?php
session_start();

$key = $_POST['k'];
$value = $_POST['v'];

$_SESSION[$key] = $value;

echo json_encode(array($key => $_SESSION[$key]));
exit;