<?php
require_once("_system/_config.php");
$connect = new mysqli('https://databases.000webhost.com/', 'id21970520_root', '5rXf>_W0aat4Nfv|', 'id21970520_storyworld');

// Check if the connection is successful
if ($connect->connect_errno) {
    die("Failed to connect to MySQL: " . $connect->connect_error);
}
else{
    echo "hello";
}
?>