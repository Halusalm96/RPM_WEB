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
        <h1 class="ticket-title">이용권 관리</h1>
        <div class="home-button">
            <a href="/login/main_page.php"><img src="./icon/home.png" alt="메인메뉴"></a>
        </div>
        <div id="ticket-table">
            <table>
                <thead>
                    <tr>
                        <th>ticket_no</th>
                        <th>ticket_code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'functions.php';
                    
                    $tickets = getAllTickets();
                    foreach ($tickets as $ticket) {
                        echo "<tr>";
                        echo "<td>" . $ticket['ticket_no'] . "</td>";
                        echo "<td>" . $ticket['ticket_code'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
