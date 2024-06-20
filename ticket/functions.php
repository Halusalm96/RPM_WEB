<?php
include "../db_conn.php";

// 모든 놀이기구 정보를 가져오는 함수
function getAllTickets() {
    global $conn;
    $sql = "SELECT ticket_no, ticket_code FROM ticket";
    $result = $conn->query($sql);
    $tickets = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tickets[] = $row;
        }
    }
    return $tickets;
}
?>
