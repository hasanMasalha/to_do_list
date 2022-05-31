<!DOCTYPE html>
<?php require_once("header.php");?>
<?php 
    require_once('db.php');
    if($_POST && isset($_POST['user_email']))
    {
        $email = $_POST['user_email'];
        $_SESSION["user_email"] = $email;
        $sql = "SELECT * FROM users WHERE `email` = \"$email\"";
        $emailVerify = ($conn->query($sql))->fetch_row();
        if(isset($emailVerify[1]))
        {
            $_SESSION["Alert"] = "YOU DID IT";
            header('Location: passwordChanger.php');
            exit;
        }else
        {
            echo '<script>alert("Email Not Found!")</script>';
        }
    }
?>

<html>
    <head>
        <title>Reset Password</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header">
                        <h3>Reset Password</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="user_email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="user_email" id="user_email" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <button id="verify_Mail" class="btn btn-primary" name="password_changer"> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src = "myScript2.js"></script>
    </body>
</html>