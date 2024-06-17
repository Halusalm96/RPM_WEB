<?php
header('Content-Type: text/html; charset=utf-8');
include "../auth_check.php";
include "../db_conn.php";

// �����ͺ��̽����� �κ� ��ġ ������ �������� ����
$sql = "SELECT robot_x, robot_y, status FROM robot WHERE robot_key = 1";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['success'] = true;
    $response['robot'] = array(
        'robot_x' => $row['robot_x'],
        'robot_y' => $row['robot_y'],
        'robot_status' => $row['status']
    );
} else {
    $response['success'] = false;
}

// JSON �������� ������ ��ȯ
header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);

// �����ͺ��̽� ���� �ݱ�
$conn->close();
?>
