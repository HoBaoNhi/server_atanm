

<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] != 'leader') {
    exit("Bạn chưa đăng nhập!");
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h1>Trang Leader</h1>
<p>Chào <?php echo $_SESSION['username']; ?></p>
<p>Xin chao Leader</p>
<a href="logout.php">Logout</a>
</div>