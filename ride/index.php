<?php
include "../auth_check.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>놀이공원 관리 시스템</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
        }
        .left-panel {
            width: 60%;
            padding: 20px;
        }
        .right-panel {
            width: 40%;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .edit-form, .add-form {
            display: none;
        }
    </style>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="../modal.js"></script>
	<script>
        $(document).ready(function(){
            function updateRobotPosition() {
                $.ajax({
                    url: "/robot/testmap.php", // 데이터를 처리할 PHP 파일의 경로
                    type: "GET",
                    success: function(data) {
                        $("#robot_position").html(data); // 로봇 위치 정보를 표시할 div에 데이터 삽입
                    }
                });
            }

            // 1초마다 로봇 위치를 업데이트
            setInterval(updateRobotPosition, 1000); // 1초마다 업데이트
        });
    </script>
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

            // 수정 버튼 클릭 이벤트
            $(document).on('click', '.edit-button', function(){
                var row = $(this).closest('tr');
                var targetId = row.find('.target-id').text();
                var targetName = row.find('.target-name').text();
                var waitTime = row.find('.wait-time').text();
                var openTime = row.find('.open-time').text();
                var closeTime = row.find('.close-time').text();
                var minHeight = row.find('.min-height').text();
                var maxHeight = row.find('.max-height').text();
                var targetX = row.find('.target-x').text();
                var targetY = row.find('.target-y').text();
                var targetStatus = row.find('.target-status').text();

                $('#edit_target_id').val(targetId);
                $('#edit_target_name').val(targetName);
                $('#edit_wait_time').val(waitTime);
                $('#edit_open_time').val(openTime);
                $('#edit_close_time').val(closeTime);
                $('#edit_min_height').val(minHeight);
                $('#edit_max_height').val(maxHeight);
                $('#edit_target_x').val(targetX);
                $('#edit_target_y').val(targetY);
                $('#edit_target_status').val(targetStatus);

                $('.edit-form').show();
                $('.add-form').hide();
            });
			
			// 수정 폼 취소 버튼 클릭 이벤트
            $('#cancel-edit').click(function(){
                $('.edit-form').hide();
            });

            // 수정 폼 제출 이벤트
            $('#edit-form').submit(function(event){
                event.preventDefault();
                $.ajax({
                    url: 'target_update.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('정보가 업데이트되었습니다.');
                        loadTable();
                        $('.edit-form').hide();
                    },
                    error: function() {
                        alert('정보 업데이트에 실패했습니다.');
                    }
                });
            });

            // 추가 버튼 클릭 이벤트
            $('#add-button').click(function(){
                $('.edit-form').hide();
                $('.add-form').show();
            });

            // 추가 폼 취소 버튼 클릭 이벤트
            $('#cancel-add').click(function(){
                $('.add-form').hide();
            });

            // 추가 폼 제출 이벤트
            $('#add-form').submit(function(event){
                event.preventDefault();
                $.ajax({
                    url: 'target_add.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('놀이기구가 추가되었습니다.');
                        loadTable();
                        $('.add-form').hide();
                    },
                    error: function() {
                        alert('놀이기구 추가에 실패했습니다.');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h1>놀이공원 관리 시스템</h1>
    <div class="container">
        <div class="left-panel">
            <h2>놀이기구 목록</h2>
            <div id="target-table"></div> <!-- 표를 표시할 위치 -->
			<!-- 로봇 관제 시스템 -->
			<!-- <iframe src="/robot" width="700" height="700" frameborder="0"></iframe> -->
        </div>
        <div class="right-panel">
            <h2>놀이기구 정보 수정</h2>
            <form id="edit-form" class="edit-form">
                <input type="hidden" id="edit_target_id" name="target_id">
                <label for="edit_target_name">놀이기구 이름:</label>
                <input type="text" id="edit_target_name" name="target_name" required><br><br>

                <label for="edit_wait_time">대기 시간 (분):</label>
                <input type="number" id="edit_wait_time" name="wait_time" required><br><br>

                <label for="edit_open_time">개장 시간:</label>
                <input type="text" id="edit_open_time" name="open_time" required><br><br>

                <label for="edit_close_time">폐장 시간:</label>
                <input type="text" id="edit_close_time" name="close_time" required><br><br>

                <label for="edit_min_height">최소 키 제한 (cm):</label>
                <input type="number" id="edit_min_height" name="min_height" required><br><br>

                <label for="edit_max_height">최대 키 제한 (cm):</label>
                <input type="number" id="edit_max_height" name="max_height" required><br><br>

                <label for="edit_target_x">X 좌표:</label>
                <input type="number" step="0.0001" id="edit_target_x" name="target_x" required><br><br>

                <label for="edit_target_y">Y 좌표:</label>
                <input type="number" step="0.0001" id="edit_target_y" name="target_y" required><br><br>

                <label for="edit_target_status">상태:</label>
                <select id="edit_target_status" name="target_status" required>
                    <option value="Open">Open</option>
                    <option value="Close">Close</option>
                </select><br><br>

                <input type="submit" value="정보 업데이트">
				<button type="button" id="cancel-edit">취소</button>
            </form>

            <h2>놀이기구 추가</h2>
            <button id="add-button">놀이기구 추가</button>
            <form id="add-form" class="add-form">
                <label for="add_target_name">놀이기구 이름:</label>
                <input type="text" id="add_target_name" name="target_name" required><br><br>

                <label for="add_wait_time">대기 시간 (분):</label>
                <input type="number" id="add_wait_time" name="wait_time" required><br><br>

                <label for="add_open_time">개장 시간:</label>
                <input type="text" id="add_open_time" name="open_time" required><br><br>

                <label for="add_close_time">폐장 시간:</label>
                <input type="text" id="add_close_time" name="close_time" required><br><br>

                <label for="add_min_height">최소 키 제한 (cm):</label>
                <input type="number" id="add_min_height" name="min_height" required><br><br>

                <label for="add_max_height">최대 키 제한 (cm):</label>
                <input type="number" id="add_max_height" name="max_height" required><br><br>

                <label for="add_target_x">X 좌표:</label>
                <input type="number" step="0.0001" id="add_target_x" name="target_x" required><br><br>

                <label for="add_target_y">Y 좌표:</label>
                <input type="number" step="0.0001" id="add_target_y" name="target_y" required><br><br>

                <label for="add_target_status">상태:</label>
                <select id="edit_target_status" name="target_status" required>
                    <option value="Open">Open</option>
                    <option value="Close">Close</option>
                </select><br><br>

                <input type="submit" value="추가">
                <button type="button" id="cancel-add">취소</button>
            </form>
        </div>
    </div>
</body>
</html>
