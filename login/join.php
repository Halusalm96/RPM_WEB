<?php
include "../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    
    if($password === $password_confirm){
      
      $sql = "INSERT INTO users (email, password, username) VALUES ('$email', '$password', '$name')";
      $result = $conn->query($sql);

	  echo "<script>alert('회원가입 되었습니다!'); window.location.href = '/index.html';</script>";
    }
    
    else{
      echo "패스워드가 일치하지 않습니다.";
    }
	
   }
?>