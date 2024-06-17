<?php
include "../db_conn.php";

// POST 데이터 가져오기 (필드명에 맞춰서 변수명 수정)
$target_name = $_POST['target_name'];
$wait_time = $_POST['target_wait_time'];
$open_time = $_POST['target_open_time'];
$close_time = $_POST['target_close_time'];
$min_height = $_POST['target_min_height'];
$max_height = $_POST['target_max_height'];
$target_x = $_POST['target_x'];
$target_y = $_POST['target_y'];
$target_status = $_POST['target_status'];
$target_utilization = $_POST['target_utilization'];
$target_precautions = $_POST['target_precautions'];

// 데이터 삽입 쿼리
$sql = "INSERT INTO target (target_name, target_wait_time, target_open_time, target_close_time, target_min_height, target_max_height, target_x, target_y, target_status, target_utilization, target_precautions) 
        VALUES ('$target_name', '$wait_time', '$open_time', '$close_time', '$min_height', '$max_height', '$target_x', '$target_y', '$target_status', '$target_utilization', '$target_precautions')";

if ($conn->query($sql) === TRUE) {
    echo "놀이기구가 성공적으로 추가되었습니다.";
} else {
    echo "오류: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();
?>
