<?php
include "../db_conn.php";

// 데이터베이스에서 로봇 위치 정보를 가져오는 쿼리
$sql = "SELECT current_x, current_y, status FROM robot WHERE robot_id = 1";
$result = $conn->query($sql);

// 초기 위치 설정
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // 로봇의 좌표를 점으로 표시
        $x = 379 + $row["current_x"] * 20;
		$y = 348 - ($row["current_y"] * 20);
        $color = $row["status"] == "online" ? "red" : "gray"; // 상태에 따른 색상 결정
        echo "<div class='robot' style='left: ".$x."px; top: ".$y."px; background-color: $color;'></div>";
    }
} else {
    echo "로봇 위치 정보가 없습니다.";
}

// 데이터베이스 연결 닫기
$conn->close();
?>