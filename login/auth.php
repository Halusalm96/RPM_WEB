<?php
include "../db_conn.php";
session_start();

// 로그인 처리
function login($email, $username) {
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;
}

// 로그아웃 처리
function logout() {
    // 세션 변수 모두 삭제
    session_unset();
    // 세션 삭제
    session_destroy();
}
?>