<?php
include "../auth_check.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>놀이공원 관리 시스템</title>
    <link rel="stylesheet" href="styles_ride.css">
    <link rel="stylesheet" href="/styles_back.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            // 데이터 로드
            function loadTable() {
                $.ajax({
                    url: 'target_get.php',
                    type: 'GET',
                    success: function(data) {
                        $('#target-table').html(data);
                    },
                    error: function() {
                        alert('데이터를 가져오는 데 실패했습니다.');
                    }
                });
            }
            loadTable();
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>놀이공원 관리 시스템</h1>
        </div>
        <div class="back-button">
            <img src="./icon/back.png" alt="뒤로가기" onclick="history.back()">
        </div>
        <div class="add-button">
            <img src="./icon/plus.png" alt="추가" onclick="location.href='add_page.php'">
        </div>
        <div class="scroll">
            <h2>놀이기구 목록</h2>
            <div id="target-table"></div> <!-- 표를 표시할 위치 -->
        </div>
    </div>
</body>
</html>
