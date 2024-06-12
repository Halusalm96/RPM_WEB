<?php
include "../db_conn.php";

// 놀이기구 정보 조회 쿼리
$sql = "SELECT * FROM target";
$result = $conn->query($sql);
?>

<table>
    <tr>
        <th>ID</th>
        <th>이름</th>
        <th>대기 시간</th>
        <th>개장 시간</th>
        <th>폐장 시간</th>
        <th>최소 키</th>
        <th>최대 키</th>
        <th>X 좌표</th>
        <th>Y 좌표</th>
        <th>상태</th>
        <th>수정</th>
    </tr>
    <?php
    // 놀이기구 정보를 테이블로 표시
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='target-id'>" . $row["target_id"] . "</td>";
            echo "<td class='target-name'>" . $row["target_name"] . "</td>";
            echo "<td class='wait-time'>" . $row["wait_time"] . "</td>";
            echo "<td class='open-time'>" . $row["open_time"] . "</td>";
            echo "<td class='close-time'>" . $row["close_time"] . "</td>";
            echo "<td class='min-height'>" . $row["min_height"] . "</td>";
            echo "<td class='max-height'>" . $row["max_height"] . "</td>";
            echo "<td class='target-x'>" . $row["target_x"] . "</td>";
            echo "<td class='target-y'>" . $row["target_y"] . "</td>";
            echo "<td class='target-status'>" . $row["target_status"] . "</td>";
            echo "<td><button class='edit-button'>수정</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='11'>놀이기구 정보가 없습니다.</td></tr>";
    }

    // 데이터베이스 연결 종료
    $conn->close();
    ?>
</table>