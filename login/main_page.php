<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>RPM 로봇 관제 시스템</title>
  <link rel="stylesheet" href="styles_main.css">
  <link rel="stylesheet" href="styles_login.css">
</head>
<body>
  <div class="container">
    <div class="login-link">
      <?php
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
          echo '<p>' . $_SESSION['manager_name'] . '님 (' . $_SESSION['role'] . ') 
          <a href="logout.php"><img src="./icon/logout_icon.png" alt="로그아웃"></a> 
          <a href="user_update.php"><img src="./icon/update_user.png" alt="로그아웃"></a>
          </p>';
      } else {
          echo '<a href="/index.html"><img src="./icon/login_icon.png" alt="로그인"></a>';
      }
      ?>
    </div>
    <h2>RPM Main</h2>
    <div class="button-container">
      <button onclick="location.href='/robot'">로봇 관제</button>
      <button onclick="location.href='/ride'">놀이기구 관리</button>
      <button onclick="location.href='/posts/posts.php'">게시판</button>
    </div>
  </div>
</body>
</html>
