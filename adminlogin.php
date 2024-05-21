<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        center {
            margin-top: 100px;
        }
header {
    background-color:#f6efef;
    color: #fff;
    padding: 20px;
    text-align: center;
    position: relative;
}

header img {
    width: 800px;
    height: 80px;
}

header .admin-button {
    position: absolute;
    top: 20px;
    right: 20px;
}

header h1 {
    margin-top: 10px;
    font-size: 24px;
}
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
footer {
    background-color: #870459;
    color: #fff;
    padding: 10px;
    text-align: center;
    width: 100%;
    position: fixed;
    bottom: 0;
    left: 0;
    z-index: 999; /* Ensure the footer appears above other content */
}
    </style>
</head>
<body>
    <header>
        <div class="main">
            <div class="header-content">
                <img src="https://www.gitamw.ac.in/media/logo/gitam5.png" alt="college logo">
            </div>
    </header>
    <center>
        <h2>Login</h2>
        <form method="post">
            <input type="text" name="loginid" id="loginid" placeholder="Login ID" /><br><br>
            <input type="password" name="loginpwd" id="loginpwd" placeholder="Password" /><br><br>
            <button type="submit" name="login">Login</button>
        </form>
    </center>
    <?php
    if(isset($_POST['login'])){
        $_SESSION['loginid'] = $_POST['loginid'];
        $_SESSION['loginpwd'] = $_POST['loginpwd'];
        header('Location: adminhome.php');
    }
    ?>
    <footer>
        <p>&copy; Student Feedback Form Developed by:</p>
        <p>C.Swarnalatha | M.Sucharitha | K.Rama Dharani | G.Madhavi Latha</p>
    </footer>
</body>
</html>
