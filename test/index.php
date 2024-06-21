<?php
// 데이터베이스 연결 파일 불러오기
include "../db_conn.php";

// 데이터베이스 쿼리 예시: 로봇의 현재 위치 좌표를 가져오기
$query = "SELECT robot_x, robot_y FROM robot ORDER BY robot_no DESC LIMIT 1";  // 예시 쿼리: 가장 최근 로봇 위치 데이터 가져오기

try {
    // 쿼리 실행
    $stmt = $pdo->query($query);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // JSON 형식으로 데이터 반환
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        // 데이터가 없을 경우 처리
        echo json_encode(array('error' => 'No data available'));
    }
} catch (PDOException $e) {
    // 쿼리 실행 중 예외 처리
    echo json_encode(array('error' => 'Database error: ' . $e->getMessage()));
}
?>
