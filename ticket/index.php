<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>이용권 관리</title>
    <link rel="stylesheet" href="styles_ticket.css">
    <link rel="stylesheet" href="/styles_home.css">
</head>
<body>
    <div class="container">
    <body>
    <h1>이용권 생성 테스트</h1>
    <form method="POST" action="generate_ticket.php">
        <div class="input-row">
            <input type="submit" value="QR 생성">
        </div>
    </form>
    <br>
    <table>
        <thead>
            <tr>
                <th>ticket_no</th>
                <th>ticket_code</th>
                <th>ticket_qr</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
            require '../db_conn.php';
            $result = $conn->query("SELECT * FROM ticket");

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['ticket_no']}</td>";
                    echo "<td>{$row['ticket_code']}</td>";
                    echo "<td><img src='{$row['ticket_qr']}' alt='QR Code'></td>";
                    echo "</tr>";
                }
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
        </div>
    </div>
</body>
</html>
