<?php
$conn = new mysqli("localhost", "root", "", "user_ATANM");

// Danh sách user cần cập nhật
$users = [
    "leader" => "123",
    "technique" => "123",
    "designer" => "123"
];

foreach ($users as $username => $password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
    $stmt->bind_param("ss", $hash, $username);
    $stmt->execute();
}

echo "Đã hash xong!";
?>