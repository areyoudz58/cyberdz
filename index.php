<?php
session_start();
include "config.php";
include "hash.php";
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>MbSecurity - تسجيل الدخول</title>
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        input {
            padding: 10px;
            margin: 10px;
            width: 250px;
            border-radius: 5px;
            border: none;
        }
        button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #ff5722;
            color: #fff;
            cursor: pointer;
        }
        .instagram {
            margin-top: 50px;
        }
        a {
            color: #2196f3;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h1>مرحبًا بك في MbSecurity</h1>
<p>سجل الدخول للمتابعة</p>

<?php
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['PASSWORD'])){
            $_SESSION['user'] = $user['NAME'];
            echo "<p style='color:lime;'>تم تسجيل الدخول بنجاح! مرحباً " . $user['NAME'] . "</p>";
        } else {
            echo "<p style='color:red;'>كلمة المرور خاطئة!</p>";
        }
    } else {
        echo "<p style='color:red;'>المستخدم غير موجود!</p>";
    }
}
?>

<form method="post">
    <input type="email" name="email" placeholder="البريد الإلكتروني" required><br>
    <input type="password" name="password" placeholder="كلمة المرور" required><br>
    <button type="submit" name="login">تسجيل الدخول</button>
</form>

<div class="instagram">
    تابعني على <a href="https://instagram.com/mohamedmb277" target="_blank">@mohamedmb277</a>
</div>

</body>
</html>
