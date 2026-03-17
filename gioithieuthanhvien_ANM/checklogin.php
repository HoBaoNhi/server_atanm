<?php
session_start();

// Kết nối database
$conn = new mysqli("localhost", "root", "", "user_ATANM");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

// Kiểm tra rỗng
if (empty($username) || empty($password)) {
    echo "Vui lòng nhập đầy đủ thông tin!";
    exit();
}

// 🔥 So sánh trực tiếp username + password
$stmt = $conn->prepare("SELECT id, username, role FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra đăng nhập
if ($row = $result->fetch_assoc()) {

    // Lưu session
    $_SESSION['username'] = $row['username'];
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['role'] = $row['role'];

    // 🎯 Điều hướng theo TỪNG USER (không phải role)
    switch ($row['username']) {

        case 'leader':
            header("Location: a1.php");
            break;

        case 'technique':
            header("Location: a2.html");
            break;

        case 'designer':
            header("Location: a3.html");
            break;

        default:
            header("Location: dashboard.php");
            break;
    }

    exit();

} else {
    echo "Sai tài khoản hoặc mật khẩu!";
}

$stmt->close();
$conn->close();
?>