<?php
session_start();

// nếu chưa login thì quay về login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
</head>
<body>

<h2>Xin chào: <?php echo $username; ?></h2>

<?php
// phân quyền hiển thị

if ($role == "admin") {
    echo "<h3>Trang Admin</h3>";
    echo "<p>Quản lý hệ thống, user, database</p>";
}

elseif ($role == "teacher") {
    echo "<h3>Trang Giáo viên</h3>";
    echo "<p>Quản lý lớp học, bài giảng</p>";
}

elseif ($role == "student") {
    echo "<h3>Trang Sinh viên</h3>";
    echo "<p>Xem bài học, nộp bài</p>";
}
?>

<br>
<a href="logout.php">Đăng xuất</a>

</body>
</html>