<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>RPM 로봇 관제 시스템</title>
  <style>
    /* 스타일링을 위한 CSS 코드 */
    body {
      font-family: Arial, sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 600px;
      height: 400px;
      border: 1px solid #ccc;
      background-color: #f4f4f4;
      position: relative; /* 컨테이너를 기준으로 위치 설정하기 위해 */
    }
    h2 {
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px;
    }
    .form-group {
      margin-bottom: 20px;
      text-align: center;
    }
    .input-row {
      display: flex;
      align-items: center;
    }
    .input-label {
      font-size: 18px;
      margin-right: 10px;
    }
    /* 버튼 */ 
    .button-container {
      display: flex;
      justify-content: space-between;
      width: 90%;
    }
    input[type="submit"] {
      width: calc(50% - 10px); /* 각 버튼의 너비를 설정합니다. 여기서 10px는 버튼 사이의 간격을 의미합니다. */
      height: 150px;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: 2px solid #ccc;
      cursor: pointer;
      font-size: 18px;
    }
    .login-link {
      position: absolute;
      top: 10px;
      right: 10px;
    }
    .login-link img {
      width: 30px;
      vertical-align: middle;
      margin-right: 5px;
    }
    .login-link a {
      text-decoration: none;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>RPB Main</h2>
    <div class="button-container">
      <input type="submit" value="로봇 관제" onclick="location.href='/robot'">
      <input type="submit" value="놀이기구 관리" onclick="location.href='/ride'">
      <!-- <input type="submit" value="게시판" onclick="location.href='/posts'"> -->
    </div>
    <div class="login-link">
      <?php
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
          echo '<p>' . $_SESSION['username'] . '님 (' . $_SESSION['role'] . ') <a href="logout.php"><img src="logout_icon.png" alt="로그아웃"></a></p>';
      } else {
          echo '<a href="/index.html"><img src="login_icon.png" alt="로그인"></a>';
      }
      ?>
    </div>
  </div>
</body>
</html>
