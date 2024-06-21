<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>이용권 관리</title>
    <link rel="stylesheet" href="styles_ticket.css">
    <link rel="stylesheet" href="/styles_back.css">
</head>
<body>
    <div class="container">
        <h1>이용권 관리</h1>
        <div class="back-button">
            <img src="./icon/back.png" alt="뒤로가기" onclick="history.back()">
        </div>
        <form method="POST" action="generate_ticket.php">
            <div class="input-row">
                <input type="submit" value="QR 생성">
            </div>
        </form>
        <br>
        <table>
            <thead>
                <tr>
                    <th>티켓 번호</th>
                    <th>티켓 코드</th>
                    <th>QR 코드</th>
                    <th>작업</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                require '../db_conn.php';
                
                // POST로 받은 삭제 요청 처리
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_ticket'])) {
                    include 'delete_ticket.php'; // 삭제 처리 파일을 포함
                }
                
                // 티켓 목록 조회 및 출력
                $result = $conn->query("SELECT * FROM ticket");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['ticket_no']}</td>";
                        echo "<td>{$row['ticket_code']}</td>";
                        echo "<td><img src='{$row['ticket_qr']}' alt='QR Code'></td>";
                        echo "<td>
                                <form method='POST' action=''>
                                    <input type='hidden' name='ticket_no' value='{$row['ticket_no']}'>
                                    <input type='submit' name='delete_ticket' value='삭제'>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>티켓이 없습니다.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
