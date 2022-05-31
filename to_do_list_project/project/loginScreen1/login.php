<?php require_once("header.php");?>
<?php 
    require_once('db.php');
    if (isset($_SESSION["Alert"]))
    {
        echo '<script>alert("Password changed successfully!")</script>';
        unset($_SESSION["Alert"]);
    }
    $save_password = "off";
    if(isset($_COOKIE["user_email"]))
    {
        header('Location: ../tasksScreen/try.php');
    }
    if($_POST)
    {
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        if(isset($_POST['save_password']))
        {
            $save_password = $_POST['save_password'];
        }
        if(isset($user_email))
        {
            $sql = "SELECT * FROM users WHERE `email` = \"$user_email\" AND `password` = \"$user_password\"";
            $user = ($conn->query($sql))->fetch_row();
            if(isset($user[0]))
            {
                $_SESSION["user_email"] = $user_email;
                $_SESSION["group_id"] = $user[4];
                if($save_password == "on")
                {
                    setcookie("user_email", $user_email, strtotime("1 week"));
                }
                header('Location: ../tasksScreen/try.php');
                exit;
            }
            else
            {
                echo '<script>alert("Login Has Failed!")</script>';
            }
        }
        else
        {
            echo '<script>alert("Mail Does Not Exist!")</script>';
        }
    }
?>


<div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <div>
                        <div class="card-header">
                            <h3>התחברות</h3>
                        </div>
                        <form method="POST" id="loginForm">
                            <div class="mb-3">
                                <label for="user_email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="user_email" id="user_email" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="user_password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="user_password" id="user_password">
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" class="" name="save_password" id="save_password">
                                <label for="save_password" class="form-label"> save password </label>
                            </div>
                            <button type="submit" class="btn btn-primary"> התחברות </button>
                            <br>
                            <br>
                        </form>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">
                                Don't have an account?--  <a href="registration.php"> Sign Up </a>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="forgotPassword.php">Forgot your password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once("footer.php");?>