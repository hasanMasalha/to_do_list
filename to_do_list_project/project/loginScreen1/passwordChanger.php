<!DOCTYPE html>
<?php require_once("header.php");?>

<?php
    if (isset($_SESSION["Alert"]))
    {
        echo '<script>alert("Email Correct!")</script>';
        unset($_SESSION["Alert"]);
    }
    $email = $_SESSION["user_email"];

    require_once('db.php');
    if($_POST)
    {
        $password = $_POST['password'];
        $sql = "UPDATE users SET `password` = \"$password\" WHERE `email` = \"$email\"";
        if($conn->query($sql) === TRUE)
        {
            $_SESSION["Alert"] = "YOU DID IT";
            header('Location: login.php');
        }else{
            echo "An Error Occured " . $conn->error;
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
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="ver_password" class="form-label">Verify Password</label>
                                <input type="password" class="form-control" name="ver_password" id="ver_password" aria-describedby="emailHelp">
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