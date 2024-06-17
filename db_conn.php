<?php
// DB 연결 정보
//$servername = "13.124.83.151";
//$username = "root";
//$password = "1235";
//$dbname = "rpm";

// 로컬 DB
// $servername = "39.120.22.103";
$servername = "192.168.55.118";
$username = "rpm";
$password = "19991215";
$dbname = "rpm";

// DB 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
die("DB 연결 실패: " . $conn->connect_error);
}
?>