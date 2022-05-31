<!DOCTYPE html>
<?php require_once("header.php");?>
<?php
    require_once("db.php");
    if(isset($_GET['addUser'])){
        $user_email = $_GET['user_email'];
        $verEmail = $_GET['verEmail'];
        $password = $_GET['password'];
        $verPassword = $_GET['verPassword'];
        $fullName = $_GET['fullName'];
        $group_id = $_GET['group_id'];
        $repeatMail = "SELECT * FROM users WHERE `email` = \"$user_email\"";
        $result = $conn->query($repeatMail);
        if($user_email != $verEmail || $password != $verPassword)
        {
            echo '<script>alert("Mail or Password are wrong please try again!")</script>';
        }
        elseif(isset($result->fetch_row()[0]))
        {
            echo '<script>alert("Email already exists!")</script>';
        }
        else
        {
            $sql = "INSERT INTO `users`(`email`, `fullName`, `password`, `group_id`, `group_manager`)
            VALUES('$user_email', '$fullName', '$password', $group_id, 0)";
            if($conn->query($sql) === TRUE)
            {
                echo '<script>alert("New User Added Successfully!")</script>';
                header('Location: login.php');
            }
            else
            {
                echo "An Error Occured " . $conn->error;
            }
        }
    }
?>

<html>
    <head>
        <title>Registration Page</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="card" style="width: 30rem;">
                    <div class="card-header">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                    <label for="user_email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="user_email" id="user_email" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="ver_user_email" class="form-label">Email address Verify</label>
                                    <input type="email" class="form-control" name="verEmail" id="verEmail" aria-describedby="passwordHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="verPassword" class="form-label">Verify Password</label>
                                    <input type="password" class="form-control" name="verPassword" id="verPassword" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="group_id" class="form-label">group</label>
                                    <input type="number" class="form-control" name="group_id" id="group_id" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="fullName" class="form-label">User name</label>
                                    <input type="text" class="form-control" name="fullName" id="fullName" aria-describedby="emailHelp">
                                </div>
                            <div class="form-group">
                                <button id = "submitChecker" class="btn btn-primary" name="addUser"> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>