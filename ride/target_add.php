<?php
include "../db_conn.php";

// POST 데이터 가져오기
$target_name = $_POST['target_name'];
$wait_time = $_POST['wait_time'];
$open_time = $_POST['open_time'];
$close_time = $_POST['close_time'];
$min_height = $_POST['min_height'];
$max_height = $_POST['max_height'];
$target_x = $_POST['target_x'];
$target_y = $_POST['target_y'];
$target_status = $_POST['target_status'];

// 데이터 삽입 쿼리
$sql = "INSERT INTO target (target_name, wait_time, open_time, close_time, min_height, max_height, target_x, target_y, target_status) 
        VALUES ('$target_name', '$wait_time', '$open_time', '$close_time', '$min_height', '$max_height', '$target_x', '$target_y', '$target_status')";

if ($conn->query($sql) === TRUE) {
    echo "새 놀이기구가 성공적으로 추가되었습니다.";
} else {
    echo "오류: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();
?>
