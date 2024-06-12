<?php
// DB 연결 정보
$servername = "192.168.0.118";
$username = "rpm";
$password = "11223344";
$dbname = "rpm";

// DB 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
die("DB 연결 실패: " . $conn->connect_error);
}
?>