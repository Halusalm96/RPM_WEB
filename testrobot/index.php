<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로봇 위치 관제 시스템</title>
    <style>
        #mapCanvas {
            border: 1px solid #000; /* 캔버스 테두리 스타일 */
            background-image: url('your_map_image.jpg'); /* 배경 이미지 설정 */
            background-size: contain; /* 배경 이미지 크기 조정 */
        }
    </style>
</head>
<body>
    <h1>로봇 위치 관제 시스템</h1>
    <canvas id="mapCanvas" width="800" height="600"></canvas> <!-- 캔버스 요소 -->
    <script src="https://cdn.jsdelivr.net/npm/roslib@0.23.1/dist/roslib.min.js"></script>
    <script>
        var ros = new ROSLIB.Ros({
            url: 'ws://192.168.123.118:9090' // ROS_IP는 ROS가 실행 중인 로컬 IP 주소입니다.
        });

        ros.on('connection', function() {
            console.log('Connected to ROS');
        });

        ros.on('error', function(error) {
            console.log('Error connecting to ROS:', error);
        });

        ros.on('close', function() {
            console.log('Disconnected from ROS');
        });

        // 예시: 로봇 위치 정보 수신
        var robotListener = new ROSLIB.Topic({
            ros: ros,
            name: '/tf',
            messageType: 'tf2_msgs/TFMessage'
        });

        robotListener.subscribe(function(message) {
            console.log('Received robot pose message:', message);
            
            // Canvas 요소 가져오기
            var canvas = document.getElementById('mapCanvas');
            if (!canvas) {
                console.error('Canvas element not found');
                return;
            }
            var ctx = canvas.getContext('2d');

            // 맵 이미지를 로드한 후 그리기
            var mapImage = new Image();
            mapImage.src = 'your_map_image.jpg'; // 맵 이미지 경로 설정
            mapImage.onload = function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height); // 캔버스 클리어
                
                // 맵 이미지 그리기
                ctx.drawImage(mapImage, 0, 0, canvas.width, canvas.height);

                // 로봇 위치 계산
                var mapWidth = canvas.width; // 맵 이미지 너비
                var mapHeight = canvas.height; // 맵 이미지 높이
                var robotX = message.position.x; // 로봇 X 좌표
                var robotY = message.position.y; // 로봇 Y 좌표
                var resolution = 0.05; // 맵 해상도 설정 (ROS 맵의 해상도에 따라 조정)
                var offsetX = 200; // 맵의 X 축 오프셋
                var offsetY = 100; // 맵의 Y 축 오프셋

                // 로봇 위치 계산
                var robotCanvasX = (robotX / resolution) + offsetX;
                var robotCanvasY = mapHeight - ((robotY / resolution) + offsetY);

                // 로봇 그리기
                ctx.beginPath();
                ctx.arc(robotCanvasX, robotCanvasY, 5, 0, 2 * Math.PI);
                ctx.fillStyle = 'red';
                ctx.fill();
                ctx.stroke();
            };
        });
    </script>
</body>
</html>
