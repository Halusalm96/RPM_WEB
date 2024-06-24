<script src="https://cdn.jsdelivr.net/npm/roslib@1.1.0/build/roslib.min.js"></script>
<script>
    var ros = new ROSLIB.Ros({
        url: 'ws://192.168.123.118:9090' // ROS_IP는 ROS가 실행 중인 로컬 IP 주소입니다.
    });

    var robotStatus = {
        online: false,
        statusText: ''
    };

    var statusElement = document.getElementById('status-text');

    var statusListener = new ROSLIB.Topic({
        ros: ros,
        name: '/robot_status',
        messageType: 'std_msgs/String' // 예시로 String 메시지를 사용했습니다.
    });

    statusListener.subscribe(function(message) {
        console.log('Received robot status message:', message);
        robotStatus.online = true; // 메시지를 수신하면 온라인으로 간주
        robotStatus.statusText = message.data; // 메시지 내용을 상태 텍스트로 저장
        updateStatusUI();
    });

    function updateStatusUI() {
        if (robotStatus.online) {
            statusElement.textContent = '상태: ' + robotStatus.statusText;
            statusElement.style.color = 'green'; // 온라인 상태의 스타일
        } else {
            statusElement.textContent = '로봇 오프라인';
            statusElement.style.color = 'gray'; // 오프라인 상태의 스타일
        }
    }

    ros.on('connection', function() {
        console.log('Connected to ROS');
        updateStatusUI(); // 연결됐을 때 초기 상태 업데이트
    });

    ros.on('error', function(error) {
        console.log('Error connecting to ROS:', error);
        robotStatus.online = false; // 에러 발생 시 오프라인으로 처리
        robotStatus.statusText = '연결 오류';
        updateStatusUI();
    });

    ros.on('close', function() {
        console.log('Disconnected from ROS');
        robotStatus.online = false; // 연결 종료 시 오프라인으로 처리
        robotStatus.statusText = '연결 종료';
        updateStatusUI();
    });

    // 주기적으로 연결 상태 확인
    setInterval(function() {
        if (ros.isConnected) {
            console.log('ROS connection is alive');
        } else {
            console.log('ROS connection is not alive');
            robotStatus.online = false; // 연결 끊김 상태 처리
            robotStatus.statusText = '연결 끊김';
            updateStatusUI();
        }
    }, 5000);
</script>
