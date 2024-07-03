<?php
session_start();
include "../db_conn.php"; // 데이터베이스 연결 파일 경로에 따라 수정 필요

// 게시글 목록 조회 쿼리
$sql = "SELECT * FROM board ORDER BY created_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>게시판 리스트</title>
  <link rel="stylesheet" href="/styles_home.css">
  <link rel="stylesheet" href="styles_posts.css">
  <link rel="stylesheet" href="/login/styles_login.css">
  <link rel="stylesheet" href="styles_edit.css">
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
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #dddddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    .login-link {
      text-align: right;
      margin-bottom: 10px;
    }
    .login-link a {
      margin-left: 10px;
    }
    .edit-button {
      text-align: center;
    }
    .edit-button a {
      display: inline-block;
      padding: 5px 10px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 4px;
    }
    .edit-cell, .delete-cell {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-link">
      <?php
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
          echo '<p>' . $_SESSION['manager_name'] . '님 (' . $_SESSION['role'] . ') 
          <a href="/login/logout.php"><img src="/login/icon/logout_icon.png" alt="로그아웃"></a> 
          <a href="/login/main_page.php"><img src="./icon/home.png" alt="메인메뉴"></a>
          </p>';
      } else {
          echo '<a href="/index.html"><img src="./icon/login_icon.png" alt="로그인"></a>';
      }
      ?>
    </div>
    <h2>게시판</h2>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        echo '<div class="add-button">';
        echo '<a href="write_post.php"><img src="./icon/plus.png" alt="추가"></a>';
        echo '</div>';
    }    
    ?>
    <table>
      <thead>
        <tr>
          <th>제목</th>
          <th>작성자</th>
          <th>작성 시간</th>
          <th>수정 시간</th>
          <th>수정</th>
          <th>삭제</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><a href="view_post.php?id=' . $row['board_no'] . '">' . $row['board_title'] . '</a></td>';
                echo '<td>' . $row['board_author'] . '</td>';
                echo '<td>' . $row['created_date'] . '</td>';
                echo '<td>' . $row['updated_date'] . '</td>';
                echo '<td class="edit-cell">';
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    // 현재 로그인한 사용자와 게시글 작성자가 같은 경우에만 수정 가능
                    if ($_SESSION['manager_name'] == $row['board_author']) {
                        echo "<a href='edit_post.php?id=" . $row["board_no"] . "'><img src='./icon/edit.png' alt='수정' width='30' height='30'></a>";
                    } else {
                        echo ''; // 다른 사용자의 게시글이면 수정 버튼 없음
                    }
                } else {
                    echo ''; // 로그인하지 않은 경우 수정 버튼 없음
                }
                echo '</td>';
                echo '<td class="delete-cell">';
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    // 현재 로그인한 사용자와 게시글 작성자가 같은 경우에만 삭제 가능
                    if ($_SESSION['manager_name'] == $row['board_author']) {
                        echo "<a href='delete_post.php?id=" . $row["board_no"] . "' onclick='return confirm(\"정말로 이 게시글을 삭제하시겠습니까?\");'><img src='./icon/delete.png' alt='삭제' width='30' height='30'></a>";
                    } else {
                        echo ''; // 다른 사용자의 게시글이면 삭제 버튼 없음
                    }
                } else {
                    echo ''; // 로그인하지 않은 경우 삭제 버튼 없음
                }
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6">게시글이 없습니다.</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>

<?php
// 연결 종료
$conn->close();
?>
