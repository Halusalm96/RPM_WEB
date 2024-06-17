<?php
include "../db_conn.php";

// POST 데이터 가져오기
$target_key = $_POST['target_key'];
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

// 데이터 업데이트 쿼리
$sql = "UPDATE target SET 
        target_name='$target_name', 
        target_wait_time='$wait_time', 
        target_open_time='$open_time', 
        target_close_time='$close_time', 
        target_min_height='$min_height', 
        target_max_height='$max_height', 
        target_x='$target_x', 
        target_y='$target_y', 
        target_status='$target_status',
        target_utilization='$target_utilization',
        target_precautions='$target_precautions'
        WHERE target_key='$target_key'";

if ($conn->query($sql) === TRUE) {
    echo "놀이기구 정보가 성공적으로 업데이트되었습니다.";
} else {
    echo "오류: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();
?>