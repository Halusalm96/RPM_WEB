<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>window.location.href = '/index.html';</script>";
    exit;
}

// 세션에 저장된 사용자 역할(role) 확인
$role = $_SESSION['role'];
$target_no = $_GET['target_no'];

// 총관리자 또는 해당 놀이기구의 관리자만 접근 가능하도록 확인
if ($role !== '총관리자' && ($_SESSION['target_no'] != $target_no || $role !== '놀이기구관리자')) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showModal('권한이 부족하여 접근할 수 없습니다.', '/login/main_page.php');
            });
          </script>";
    exit;
}
?>