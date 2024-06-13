<?php
session_start();
include "../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $adminCode = $_POST['admin_code'];

    // 데이터베이스에서 입력된 이메일과 비밀번호를 가진 사용자 정보 조회
    $sql = "SELECT user_id, email, username, role FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // 사용자 정보를 가져옴
        $row = $result->fetch_assoc();

        // 로그인 성공한 사용자의 role 확인
        $role = $row['role'];

        // 관리자 코드가 입력되었고, 관리자로 인증된 경우에만 role을 업데이트
        if ($adminCode === '11223344') {
            $newRole = '총관리자';
        } else {
            $newRole = $role; // 기존 role 유지
        }

        // 사용자의 role 업데이트 쿼리 실행
        $updateSql = "UPDATE users SET role='$newRole' WHERE user_id=" . $row['user_id'];
        if ($conn->query($updateSql) === TRUE) {
            // 업데이트 성공 시 세션에 사용자 정보 저장
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $newRole; // 업데이트된 role을 세션에 저장

            // 로그인 후 메인 페이지로 리다이렉트
            header('Location: main_page.php');
            exit;
        } else {
            // 업데이트 실패 처리
            echo "<script>alert('권한 업데이트 실패'); window.location.href = '/index.html';</script>";
        }
    } else {
        // 로그인 실패 메시지
        echo "<script>alert('로그인 실패'); window.location.href = '/index.html';</script>";
    }
}
?>