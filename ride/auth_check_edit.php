<?php
session_start();
include "../db_conn.php";

function checkUserRole($targetNo) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $role = $_SESSION['role'];
        $managerId = $_SESSION['manager_id'];

        if ($role === '총관리자') {
            // 총관리자는 모든 접근을 허용
            return;
        } elseif ($role === '놀이기구관리자') {
            // 놀이기구 관리자인 경우 해당 놀이기구의 관리자 코드를 확인하여 접근을 허용
            $sql = "SELECT manager_code FROM target WHERE target_no = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $targetNo);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($managerCode);
                $stmt->fetch();

                // 사용자가 입력한 관리자 코드
                $enteredCode = $_SESSION['entered_manager_code'][$targetNo];

                // 관리자 코드 검증
                if ($enteredCode === $managerCode) {
                    return;
                } else {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                showModal('권한이 부족하여 접근할 수 없습니다.', '/login/main_page.php');
                            });
                          </script>";
                    exit;
                }
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            showModal('놀이기구 정보를 찾을 수 없습니다.', '/login/main_page.php');
                        });
                      </script>";
                exit;
            }
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showModal('권한이 부족하여 접근할 수 없습니다.', '/login/main_page.php');
                    });
                  </script>";
            exit;
        }
    } else {
        echo "<script>window.location.href = '/index.html';</script>";
        exit;
    }
}

// 세션에서 target_no 가져오기
if (isset($_GET['target_no'])) {
    $targetNo = $_GET['target_no'];
    checkUserRole($targetNo);
} else {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showModal('놀이기구 정보를 찾을 수 없습니다.', '/login/main_page.php');
            });
          </script>";
    exit;
}

$stmt->close();
$conn->close();
?>
