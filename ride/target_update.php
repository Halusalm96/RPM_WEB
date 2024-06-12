<?php
include "../db_conn.php";

// POST 데이터 가져오기
$target_id = $_POST['target_id'];
$target_name = $_POST['target_name'];
$wait_time = $_POST['wait_time'];
$open_time = $_POST['open_time'];
$close_time = $_POST['close_time'];
$min_height = $_POST['min_height'];
$max_height = $_POST['max_height'];
$target_x = $_POST['target_x'];
$target_y = $_POST['target_y'];
$target_status = $_POST['target_status'];

// 데이터 업데이트 쿼리
$sql = "UPDATE target SET 
        target_name='$target_name', 
        wait_time='$wait_time', 
        open_time='$open_time', 
        close_time='$close_time', 
        min_height='$min_height', 
        max_height='$max_height', 
        target_x='$target_x', 
        target_y='$target_y', 
        target_status='$target_status' 
        WHERE target_id='$target_id'";

if ($conn->query($sql) === TRUE) {
    echo "놀이기구 정보가 성공적으로 업데이트되었습니다.";
} else {
    echo "오류: " . $sql . "<br>" . $conn->error;
}

// 데이터베이스 연결 종료
$conn->close();
?>
