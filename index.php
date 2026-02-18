<?php
session_start();

// ======= CONFIG (بيانات قاعدة البيانات) =======
$host = "sql311.infinityfree.com";        // السيرفر
$user = "if0_41182503";                   // اسم مستخدم قاعدة البيانات
$pass = "mohamedpromax@mh";               // كلمة المرور
$db   = "if0_41182503_mbsecurity";        // اسم قاعدة البيانات

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("فشل الاتصال بالقاعدة: " . $conn->connect_error);
}

// ======= HASH FUNCTIONS (تشغيل التشفير) =======
function hashPassword($password){
    return password_hash($password, PASSWORD_DEFAULT);
}
function verifyPassword($password, $hash){
    return password_verify($password, $hash);
}

// ======= LOGIN LOGIC =======
$message = "";
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        if(verifyPassword($password, $user['PASSWORD'])){
            $_SESSION['user'] = $user['NAME'];
            $message = "<p style='color:lime;'>تم تسجيل الدخول بنجاح! مرحباً " . $user['NAME'] . "</p>";
        } else {
            $message = "<p style='color:red;'>كلمة المرور خاطئة!</p>";
        }
    } else {
        $message = "<p style='color:red;'>المستخدم غير موجود!</p>";
    }
}
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
            padding-top: 80px;
        }
        h1 {
            color: #ff5722;
        }
        input {
            padding: 12px;
            margin: 10px;
            width: 300px;
            border-radius: 8px;
            border: none;
        }
        button {
            padding: 12px 25px;
            border-radius: 8px;
            border: none;
            background-color: #ff5722;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #e64a19;
        }
        .instagram {
            margin-top: 50px;
        }
        a {
            color: #2196f3;
            text-decoration: none;
            font-weight: bold;
        }
        .message {
            margin: 15px 0;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>مرحبًا بك في MbSecurity</h1>
<p>سجل الدخول للمتابعة</p>

<div class="message"><?php echo $message; ?></div>

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
