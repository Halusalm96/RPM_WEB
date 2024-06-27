<?php
include "../auth_check.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>놀이기구 관리자 페이지</title>
    <link rel="stylesheet" href="styles_admin.css">
    <link rel="stylesheet" href="/styles_home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../modal.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="admin-title">놀이기구 관리자 페이지</h1>
        <div class="home-button">
            <a href="/login/main_page.php"><img src="./icon/home.png" alt="메인메뉴"></a>
        </div>
        <div class="show-button">
            <button class='show-code-button' onclick="location.href='admin_page_code.php'">코드열람</button>
        </div>
    </div>
    
    <script>
        function redirectToAdminPageCode() {
            window.location.href = 'admin_page_code.php';
        }
    </script>
</body>
</html>
