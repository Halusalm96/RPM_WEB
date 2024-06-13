<?php
include "../auth_check.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>로봇 위치 관제 시스템</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .map-container {
            position: relative;
            width: 606px;
            height: 391px;
            border: 1px solid black;
            background-image: url('rpm.jpg');
            background-size: cover;
        }
        .robot {
            position: absolute;
            width: 7px;
            height: 7px;
            border-radius: 50%;
        }
        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-left: 10px;
        }
    </style>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../modal.js"></script>
	
    <script>
        $(document).ready(function(){
            function updateRobotPosition() {
                $.ajax({
                    url: "rpm.php",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data.success) {
                            let robot = data.robot;
                            let color = robot.status == "online" ? "green" : "gray";
                            let x = 400 + robot.current_x * 20;
                            let y = 348 - robot.current_y * 20;
                            $("#robot_position").html(
                                `<div class='robot' style='left: ${x}px; top: ${y}px; background-color: ${color};'></div>`
                            );
                            $("#status-text").text(robot.status);
                            $("#status-indicator").css("background-color", color);
                        } else {
                            $("#robot_position").html("로봇 위치 정보가 없습니다.");
                        }
                    }
                });
            }

            // 1초마다 로봇 위치를 업데이트
            setInterval(updateRobotPosition, 1000);
        });
    </script>
</head>
<body>
    <h1>로봇 위치 관제 시스템</h1>
    <div>
        상태 : <span id="status-text"></span><div id="status-indicator" class="status-indicator"></div>
    </div>
    <div class="map-container" id="robot_position">
        <!-- 초기 로봇 위치는 PHP에서 설정됨 -->
    </div>
</body>
</html>