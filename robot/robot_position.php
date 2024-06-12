<?php
include "../db_conn.php";

// 데이터베이스에서 로봇 위치 정보를 가져오는 쿼리
$sql = "SELECT current_x, current_y, lidar_x, lidar_y FROM robot WHERE robot_id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 결과를 표 형식으로 출력
    echo "<table border='1' style='background-color: #CCCCCC;'>";
    echo "<tr><th style='width: 200px; height: 20px; vertical-align: middle;'>X 좌표</th>
	<th style='width: 200px; height: 20px; vertical-align: middle;'>Y 좌표</th>
	<th style='width: 200px; height: 20px; vertical-align: middle;'>lidar_X 좌표</th>
	<th style='width: 200px; height: 20px; vertical-align: middle;'>lidar_Y 좌표</th>
	</tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td style='width: 200px; height: 60px; vertical-align: middle;'>" . $row["current_x"]. "</td>
		<td style='width: 200px; height: 60px; vertical-align: middle;'>" . $row["current_y"]. "</td>
		<td style='width: 200px; height: 60px; vertical-align: middle;'>" . $row["lidar_x"]. "</td>
		<td style='width: 200px; height: 60px; vertical-align: middle;'>" . $row["lidar_y"]. "</td>
		</tr>";
    }
    echo "</table>";
} else {
    echo "로봇 위치 정보가 없습니다.";
}

// 데이터베이스 연결 닫기
$conn->close();
?>