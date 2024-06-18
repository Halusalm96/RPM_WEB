<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ROS Navigation</title>
</head>
<body>
    <button onclick="sendGoal()">Send Goal</button>

    <script>
        function sendGoal() {
            fetch('send_goal.php')
                .then(response => response.text())
                .then(data => console.log(data))
                .catch(error => console.error(error));
        }
    </script>
</body>
</html>
