<?php
// WebSocket 서버 주소
$host = '192.168.123.118'; // ROS 브리지 WebSocket 서버 주소로 수정하세요
$port = 9090;

try {
    // TCP/IP 소켓 연결
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket === false) {
        throw new Exception("소켓 생성 실패: " . socket_strerror(socket_last_error()));
    }

    // 연결 시도
    $result = socket_connect($socket, $host, $port);
    if ($result === false) {
        throw new Exception("소켓 연결 실패: " . socket_strerror(socket_last_error()));
    }

    // WebSocket handshake 요청 보내기
    $request = "GET / HTTP/1.1\r\n";
    $request .= "Host: {$host}\r\n";
    $request .= "Upgrade: websocket\r\n";
    $request .= "Connection: Upgrade\r\n";
    $request .= "Sec-WebSocket-Key: " . base64_encode(random_bytes(16)) . "\r\n";
    $request .= "Sec-WebSocket-Version: 13\r\n";
    $request .= "\r\n";

    socket_write($socket, $request);

    // 응답 받기
    $response = socket_read($socket, 2048);
    echo "서버 응답:\n{$response}\n";

    // 메시지 수신 대기 및 출력
    while ($buffer = socket_read($socket, 2048)) {
        echo "받은 메시지: {$buffer}\n";
    }

    // 연결 종료
    socket_close($socket);

} catch (Exception $e) {
    echo "연결 실패: {$e->getMessage()}\n";
}
