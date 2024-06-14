<?php
// DB 연결 정보
$servername = "http://rpm-web.p-e.kr/";
$username = "root";
$password = "1235";
$dbname = "rpm";

// DB 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
die("DB 연결 실패: " . $conn->connect_error);
}
?>