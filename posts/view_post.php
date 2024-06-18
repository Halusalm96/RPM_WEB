<?php
session_start();
include "../db_conn.php"; // 데이터베이스 연결 파일 경로에 따라 수정 필요

// 게시글 상세 조회 쿼리
if (isset($_GET['id'])) {
    $board_key = $_GET['id'];
    $sql = "SELECT * FROM board WHERE board_key = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $board_key);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
} else {
    echo "잘못된 접근입니다.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title><?php echo $post['board_title']; ?></title>
  <link rel="stylesheet" href="/styles_home.css">
  <link rel="stylesheet" href="styles_posts.css">
  <link rel="stylesheet" href="/login/styles_login.css">
  <link rel="stylesheet" href="/styles_back.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      background-color: #f0f0f0;
      padding: 20px;
    }
    .container {
      max-width: 800px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
    h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }
    .login-link {
      text-align: right;
      margin-bottom: 10px;
    }
    .login-link a {
      margin-left: 10px;
    }
    .post-info {
      text-align: left;
      font-size: 14px;
      margin-bottom: 20px;
    }
    .post-content {
      border: 1px solid #dddddd;
      padding: 15px;
      border-radius: 4px;
      background-color: #f9f9f9;
      text-align: left;
    }
    .edit-button {
      margin-top: 20px;
    }
    .edit-button a {
      display: inline-block;
      padding: 5px 10px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="back-button">
      <img src="./icon/back.png" alt="뒤로가기" onclick="history.back()">
    </div>
    <h2><?php echo $post['board_title']; ?></h2>
    <div class="post-info">
      <p>작성자: <?php echo $post['board_author']; ?></p>
      <p>작성 시간: <?php echo $post['created_date']; ?></p>
      <p>수정 시간: <?php echo $post['updated_date']; ?></p>
    </div>
    <div class="post-content">
      <p><?php echo nl2br($post['board_content']); ?></p>
    </div>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && $_SESSION['manager_name'] == $post['board_author']) {
        echo '<div class="edit-button">';
        echo "<a href='edit_post.php?id=" . $post["board_key"] . "'>수정</a>";
        echo '</div>';
    }
    ?>
  </div>
</body>
</html>

<?php
// 연결 종료
$conn->close();
?>
