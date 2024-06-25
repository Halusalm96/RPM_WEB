<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로봇 미니맵</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        canvas {
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <canvas id="mapCanvas" width="600" height="400"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/roslib@1.1.0/build/roslib.min.js"></script>
    <script>
        var ros = new ROSLIB.Ros({
            url: 'ws://192.168.123.118:9090'
        });

        var robotX = 0;
        var robotY = 0;

        ros.on('connection', function() {
            console.log('Connected to ROS');
        });

        ros.on('error', function(error) {
            console.log('Error connecting to ROS:', error);
        });

        ros.on('close', function() {
            console.log('Disconnected from ROS');
        });

        var robotListener = new ROSLIB.Topic({
            ros: ros,
            name: '/tf',
            messageType: 'tf2_msgs/TFMessage'
        });

        robotListener.subscribe(function(message) {
            var foundTransform = false;
            for (var i = 0; i < message.transforms.length; i++) {
                var transform = message.transforms[i];
                if (transform.header.frame_id === 'map' && transform.child_frame_id === 'base_footprint') {
                    robotX = transform.transform.translation.x;
                    robotY = transform.transform.translation.y;
                    updateMiniMap();
                    foundTransform = true;
                    break;
                }
            }
            if (!foundTransform) {
                console.log('No transform with frame_id "map" and child_frame_id "base_footprint" found in the message');
            }
        });

        function updateMiniMap() {
            var canvas = document.getElementById('mapCanvas');
            var ctx = canvas.getContext('2d');

            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Draw map (assuming mapImage is loaded)
            var mapImage = new Image();
            mapImage.src = 'map_fun.png'; // 맵 이미지 경로 설정
            mapImage.onload = function() {
                ctx.drawImage(mapImage, 0, 0, canvas.width, canvas.height);

                // Draw robot position on the mini-map
                var resolution = 0.05; // 맵 해상도
                var scale = 0.1; // 미니맵 스케일
                var robotSize = 8; // 로봇 아이콘 크기

                var robotCanvasX = robotX * scale / resolution;
                var robotCanvasY = canvas.height - (robotY * scale / resolution);

                ctx.beginPath();
                ctx.arc(robotCanvasX, robotCanvasY, robotSize, 0, 2 * Math.PI);
                ctx.fillStyle = 'green';
                ctx.fill();
                ctx.strokeStyle = 'blue';
                ctx.stroke();
            };
        }
    </script>
</body>
</html>
