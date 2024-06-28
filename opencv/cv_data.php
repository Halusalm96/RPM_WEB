<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>객체인식 관제 시스템</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="./styles_cv_data.css">
    <script>
    $(document).ready(function() {
        function fetchData() {
            $.ajax({
                url: 'fetch_data.php',
                type: 'GET',
                success: function(response) {
                    $('#data-container').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('데이터를 가져오는 중 에러 발생');
                }
            });
        }

        fetchData();
        setInterval(fetchData, 500);
    });
    </script>
</head>
<body>
    <div class="container">
        <div id="data-container">
            <!-- 데이터가 업데이트될 곳 -->
        </div>
    </div>
</body>
</html>