<?php

$conn = new mysqli("localhost","root","","user_ATANM",3306);

if ($conn->connect_error) {
    die("Kết nối thất bại");
}

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

//  kiểm tra mật khẩu nhập lại
if ($password !== $confirm) {
    echo "Mật khẩu nhập lại không khớp!";
    exit();
}

// (tuỳ chọn) kiểm tra username đã tồn tại
$check = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($check->num_rows > 0) {
    echo "Username đã tồn tại!";
    exit();
}

// mã hóa mật khẩu
$hashed = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users(username, password) VALUES('$username','$hashed')";

if ($conn->query($sql) === TRUE) {
    echo "Đăng ký thành công! <a href='login.php'>Đăng nhập</a>";
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
?>