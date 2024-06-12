<?php
session_start(); // 세션 시작

// 세션에 저장된 사용자 정보 삭제
unset($_SESSION['loggedin']);
unset($_SESSION['email']);
unset($_SESSION['username']);
unset($_SESSION['role']);

// 세션 종료
session_destroy();

// 로그아웃 후 메인 페이지로 리다이렉트 또는 다른 처리
header('Location: /index.html');
exit;
?>