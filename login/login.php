<?php
session_start(); // 세션 시작

include "../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT email, password, username, role FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // 로그인 성공
        $row = $result->fetch_assoc();

        // 세션에 사용자 정보 저장
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $row['username'];
		$_SESSION['role'] = $row['role']; // 권한관련

        // 다른 페이지로 이동 또는 리다이렉트
        header('Location: main_page.php');
		exit;
    } else {
        // 로그인 실패 메시지
        echo "<script>alert('로그인 실패'); window.location.href = '/index.html';</script>";
    }
}
?>