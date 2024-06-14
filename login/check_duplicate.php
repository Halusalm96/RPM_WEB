<?php
include "../db_conn.php";

$email_pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']); // SQL 인젝션 방지

    // 중복 확인
    $sql = "SELECT email FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if (preg_match($email_pattern, $email)) {
        if ($email === "example@abc.com") {
            echo "예시 이메일은 사용하실 수 없습니다.<br>";
        } elseif ($result && $result->num_rows > 0) { // mysqli_num_rows 대신
            echo "중복된 ID입니다.<br>"; 
        } else {
            echo "사용 가능한 ID입니다.<br>";
            $id_confirm = true;
        }
    } else {
        echo "유효하지 않은 이메일 주소입니다.";
    }
}
?>
