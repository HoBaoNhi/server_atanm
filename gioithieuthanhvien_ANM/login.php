<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Sign In / Sign Up</title>

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#2c4a8a,#00b4db);
}

.login-box{
background:#f2f2f2;
width:350px;
padding:40px;
border-radius:20px;
text-align:center;
box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

.login-box h2{
color:#1e40af;
margin-bottom:25px;
font-size:28px;
}

.input-box{
margin-bottom:15px;
text-align:left;
}

.input-box input{
width:100%;
padding:10px;
border-radius:8px;
border:1px solid #ccc;
margin-top:5px;
}

.login-btn{
width:100%;
padding:10px;
border:none;
border-radius:10px;
background:#e5e7eb;
font-weight:bold;
cursor:pointer;
margin-top:10px;
}

.login-btn:hover{
background:#d1d5db;
}

.links{
margin-top:15px;
font-size:13px;
}

.links a{
text-decoration:none;
color:#555;
display:block;
margin-top:5px;
cursor:pointer;
}

.links a:hover{
color:#1d4ed8;
}
</style>

<script>
function showRegister(){
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("registerForm").style.display = "block";
}

function showLogin(){
    document.getElementById("registerForm").style.display = "none";
    document.getElementById("loginForm").style.display = "block";
}
</script>

</head>

<body>

<div class="login-box">

<!-- LOGIN FORM -->
<div id="loginForm">
<h2>Sign In</h2>

<form method="POST" action="checklogin.php">

<div class="input-box">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="input-box">
<label>Password</label>
<input type="password" name="password" required>
</div>

<button type="submit" class="login-btn">Login</button>

<div class="links">
<a href="#" onclick="showRegister()">Forget an password?</a>
<a onclick="showRegister()">Create an Account?</a>
</div>

</form>
</div>

<!-- REGISTER FORM -->
<div id="registerForm" style="display:none;">
<h2>Sign Up</h2>

<form method="POST" action="register.php">

<div class="input-box">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="input-box">
<label>Password</label>
<input type="password" name="password" required>
</div>

<div class="input-box">
<label>Confirm Password</label>
<input type="password" name="confirm_password" required>
</div>

<button type="submit" class="login-btn">Register</button>

<div class="links">
<a onclick="showLogin()">Back to Login</a>
</div>

</form>
</div>

</body>
</html>