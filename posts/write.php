<?php
if ($result) {
    // 게시글 추가에 성공한 경우
    include "board.php";
    
} else {

    // 게시글 추가에 실패한 경우
    // 에러메세지 출력시 $error_message = mysqli_error($conn);

    include "write_failed.html";
    
}
}

else {

    // 게시글 추가에 실패한 경우
    // 에러메세지 출력시 $error_message = mysqli_error($conn);

    include "write_failed.html"; }
?>