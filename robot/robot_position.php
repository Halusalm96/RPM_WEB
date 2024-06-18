<?php
header('Content-Type: application/json');

// 임의의 로봇 좌표 (예: x와 y 좌표)
$robot_x = 400; // x 좌표
$robot_y = 300; // y 좌표

echo json_encode(array(
    'x' => $robot_x,
    'y' => $robot_y
));
?>
