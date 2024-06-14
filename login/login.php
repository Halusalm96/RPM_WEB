<?php
session_start();
include "../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manager_id = $_POST['manager_id'];
    $manager_pw = $_POST['manager_pw'];

    // Prepared Statement 사용
    $sql = "SELECT manager_no, manager_id, manager_name, manager_pw, role FROM manager WHERE manager_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $manager_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['manager_pw'];

        // 비밀번호 검증
        if (password_verify($manager_pw, $hashed_password)) {
            // 관리자 코드 검증
            $adminCode = $_POST['admin_code'];
            if ($adminCode === '11223344') {
                $newRole = '총관리자';
            } else {
                $newRole = $row['role']; // 기존 역할 유지
            }

            // 역할 업데이트
            $updateSql = "UPDATE manager SET role=? WHERE manager_no=?";
            $stmtUpdate = $conn->prepare($updateSql);
            $stmtUpdate->bind_param("si", $newRole, $row['manager_no']);
            if ($stmtUpdate->execute()) {
                // 세션에 사용자 정보 저장
                $_SESSION['loggedin'] = true;
                $_SESSION['manager_id'] = $row['manager_id'];
                $_SESSION['manager_name'] = $row['manager_name'];
                $_SESSION['role'] = $newRole;

                // 로그인 후 메인 페이지로 리다이렉션
                header('Location: main_page.php');
                exit;
            } else {
                echo "<script>alert('역할 업데이트 실패'); window.location.href = '/index.html';</script>";
            }
        } else {
            echo "<script>alert('비밀번호가 일치하지 않습니다.'); window.location.href = '/index.html';</script>";
        }
    } else {
        echo "<script>alert('등록되지 않은 ID입니다.'); window.location.href = '/index.html';</script>";
    }
    $stmt->close();
    $stmtUpdate->close();
    $conn->close();
}
?>
