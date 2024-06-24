<?php
session_start();
include "../db_conn.php"; // 데이터베이스 연결 파일 경로에 따라 수정 필요

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticket_no'])) {
    $ticket_no = $_POST['ticket_no'];
    $used_time = date('Y-m-d H:i:s');

    // 티켓이 이미 사용되었는지 확인
    $check_sql = "SELECT * FROM ticket_use WHERE ticket_no = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("i", $ticket_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // 티켓 사용 기록 추가
        $insert_sql = "INSERT INTO ticket_use (ticket_no, usage_time) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("is", $ticket_no, $used_time);
        if ($stmt->execute()) {
            echo "티켓이 성공적으로 사용되었습니다.";
        } else {
            echo "티켓 사용 중 오류가 발생했습니다.";
        }
    } else {
        echo "이 티켓은 이미 사용되었습니다.";
    }
}
?>