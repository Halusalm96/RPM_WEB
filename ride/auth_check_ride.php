<?php
session_start();

function checkUserRole() {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        //if ($_SESSION['role'] !== '직원' && $_SESSION['role'] !== '총관리자') {
		if ($_SESSION['role'] !== '총관리자') {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showModal('권한이 부족하여 접근할 수 없습니다.', '/ride');
                    });
                  </script>";
        }
    } else {
        echo "<script>window.location.href = '/index.html';</script>";
        exit;
    }
}

checkUserRole();
?>