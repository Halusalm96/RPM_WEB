<?php
include "../db_conn.php";

// 놀이기구 정보 조회 쿼리
$sql = "SELECT * FROM target";
$result = $conn->query($sql);
?>
<table>
    <tr>
        <th>이름</th>
        <th>상태</th>
        <th>수정</th>
    </tr>
    <?php
    // 놀이기구 정보를 테이블로 표시
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='target-name'>" . $row["target_name"] . "</td>";
            echo "<td class='target-status'>" . $row["target_status"] . "</td>";
            echo "<td><a href='edit_page.php?target_key=" . $row["target_key"] . "' class='edit-button'><img src='./icon/edit.png' alt='수정'></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='11'>놀이기구 정보가 없습니다.</td></tr>";
    }
    ?>
</table>
