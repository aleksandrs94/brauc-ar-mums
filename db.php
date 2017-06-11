<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'accounts';
$page = 20;
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
