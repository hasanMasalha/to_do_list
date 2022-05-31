<?php require_once("header.php");?>



<!-- Created A New Group -->
<?php
   require_once("dbUser.php");

    if (isset($_POST['addg']))
    {  
        $email = $_SESSION["user_email"];
        $group_name = $_POST['group_name1'];
        $num="1";

        if($_POST)
        {
            $_SESSION["group_id"]=$group_name;
            $sql1 = "UPDATE `users`  SET `group_id` = \"$group_name\"    WHERE `email` = \"$email\"";
            $sql2 = "UPDATE `users`  SET `group_manager` = \"$num\"  WHERE `email` = \"$email\"";

            if($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE)
                {
                    echo '<script>alert("you created a new group!")</script>';
            }
            else
            {
                    echo "An Error Occured " . $conn->error;
            }
        }
    }
?>

<!-- Add a new Group Member -->
<?php
   require_once("dbUser.php");

    if (isset($_POST['adduser'])){  
        $email = $_SESSION["user_email"];
        $new_mail = $_POST['member_email1'];
        $groupId=$_SESSION["group_id"];
        $num="0";

        if($_POST)
        {
            $sql = "SELECT * FROM users WHERE `email` = \"$email\"";
            $user = ($conn->query($sql))->fetch_row();
            echo $user[5];
            if(isset($user))
            {
                if($user[5]=='1')
                {
                    $sql = "UPDATE `users`  SET `group_id` = \"$groupId\" WHERE `email` = \"$new_mail\"";
                    $sql2 = "UPDATE `users`  SET `group_manager` = \"$num\"  WHERE `email` = \"$new_mail\"";
                    if($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE)
                    {
                        echo '<script>alert("You added a new group member!")</script>';
                    }
                    else
                    {
                            echo "An Error Occured " . $conn->error;  
                    }
                }
                else
                {
                    echo '<script>alert("you are not a group manager please first open a group!")</script>';
                }
            }
            else
            {
                echo '<script>alert("Email Incorrect please try again!")</script>';
            }
        }
    }   
?>


<!-- remove user from group -->
<?php
   require_once("dbUser.php");


    if (isset($_POST['removeUser'])){  
        $new_mail = $_POST['member_email2'];
        $groupId=$_SESSION["group_id"];
        $mymail=$_SESSION["user_email"];

        if($_POST)
        {
            $sql3 = "SELECT * FROM users WHERE `email` = \"$mymail\"";
            $user1 = ($conn->query($sql3))->fetch_row();

            $sql = "SELECT * FROM users WHERE `email` = \"$new_mail\"";
            $user = ($conn->query($sql))->fetch_row();
            if(isset($user1) && isset($user))
            {
                if($user1[5]=='1')
                {
                    $sql = "UPDATE `users`  SET `group_id` = \"-1\" WHERE `email` = \"$new_mail\"";
                    if($conn->query($sql) === TRUE)
                    {
                        echo '<script>alert("You have Removed the Group Member!")</script>';
                    }else{
                            echo "An Error Occured " . $conn->error;
                        }
                      
                }
                else
                {
                    echo '<script>alert("you are not a group manager please first open a group!")</script>';
                }  
            }
            else
            {
                echo '<script>alert("Email Incorrect please try again!")</script>';
            }
        }
    }   
?>





<?php
    require_once("db.php");
    $email = $_SESSION["user_email"];
    $group=$_SESSION["group_id"];
    $sql = "SELECT * FROM tasks WHERE `group` = \"$group\"";

    $result = $conn->query($sql);
    $tasks = array();
    while($row = $result->fetch_assoc())
    {
        $tasks[] = $row;
    }
    $conn->close();

?>


<body id =body>
    <div id=app>

   

    <nav class="navbar navbar-expand-lg navbar-dark main-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">יומן מטלות</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <button type="button" class="btnContact" data-bs-toggle="modal"id="15"
                            data-bs-target="#contactModal">
                            הוספת מטלה חדשה
                        </button>
                        </li>
                        <li class="nav-item">
                        <button type="button" class="btnContact1" data-bs-toggle="modal"id="15"
                            data-bs-target="#contactModal2">
                            יצירת קבוצה חדשה
                        </button>
                      
                    </li>
                    <li class="nav-item">
                    <button type="button" class="btnContact1" data-bs-toggle="modal"id="15"
                            data-bs-target="#contactModal3">
                              הוספת משתמש חדש לקבוצה
                        </button>
</li>
     <li class="nav-item">
                    <button type="button" class="btnContact2" data-bs-toggle="modal"id="15"
                            data-bs-target="#contactModal4">
                          ביטול השתתפות משתמש
                        </button>
        </li>
<a id="logOut" href="../loginScreen1/logout.php"> התנתקות </a>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <table class="table table-striped" id="taskTable">
            <thead>
                <tr>
                <th scope="col">שם המטלה</th>
                <th scope="col">כותב המטלה</th>
                <th scope="col">תאריך סיום מטלה</th>
                
                </tr>
            </thead>
            <tbody id = "tasksList">
                <?php foreach($tasks as $tasks): ?>
                    <tr id = <?=$tasks["id"];?>> 
                        <td class = "name_task"> <?=$tasks["name_task"];?> </td>
                        <td class="writer"> <?=$tasks["writer"];?> </td>
                        <td class="date"> <?=$tasks["date"];?> </td>
                        <td> <a class="deleteTasks" href="#" id = <?=$tasks["id"];?>> מחיקה </a> | <a class="editTasks" href="#" id = <?=$tasks["id"];?>> עריכה </a>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" >הוספת מטלה חדשה </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="addTasksForm" action="/">
                        <div class="mb-3">
                            <label for="task_name" >שם מטלה</label>
                            <input v-model="user.name1" type="text"  class="form-control" name="task_name" id="task_name" required>
                        
                        </div>
                        <div class="mb-3">
                            <label for="task_writer" >שם מחבר המטלה</label>
                            <input v-model="user.writer1" type="text"  class="form-control" name="task_writer" id="task_writer" required>
                        </div>
                        <div class="mb-3">
                            <label for="final_date" >תאריך סיום המטלה</label>
                            <input v-model="user.finalDate1" type="date"  class="form-control" name="final_date" id="final_date" required>

                        </div>
                        <div id=myTable>

              <table class="table table-striped" id="taskTable">
            <thead>
                <tr>
                <th scope="col">שם המטלה</th>
                <th scope="col">כותב המטלה</th>
                <th scope="col">תאריך סיום מטלה</th>
                
                </tr>
            </thead>
            <tbody>
            <tr>
                <td v-if="user.name1" > {{user.name1}} </td>
                <td >{{user.writer1}}</td>
                <td >{{user.finalDate1}}</td>
                </tr>
                </tbody>
                </table>


                </div>


                        <div class="container">
     
                  
                        <input type="submit" class="btn btn-primary mt-4 btn-block" name="add_task"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ביטול</button>
                </div>
            </div>
        </div>
       
     </div>
     </div>
     </div>

     <div class="modal fade" id="contactModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" > הוספת קבוצה </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  id="" method="POST">
                        <div class="mb-3">
                            <label for="group_name1" >שם קבוצה</label>
                            <input type="number" class="form-control" id="group_name1" name="group_name1" required>
                        </div>
                       
                        
                        <button type="submit" class="btn btn-primary mt-4 btn-block add" name="addg"> יצירת קבוצה</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ביטול</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="contactModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" > הוספת משתמש חדש לקבוצה </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTasksForm" method="POST">
                     
                        <div class="mb-3">
                            <label for="email" >user Email</label>
                            <input type="email" class="form-control" id="member_email1" name="member_email1" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-4 btn-block adduser" name="adduser"> הוספה לקבוצה</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ביטול</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="contactModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" > ביטול הצטרפות  </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTasksForm" method="POST">
                     
                        <div class="mb-3">
                            <label for="email" >user Email</label>
                            <input type="email" class="form-control" id="member_email2" name="member_email2" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-4 btn-block removeUser" name="removeUser">  ביטול השתתפות </button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ביטול</button>
                </div>
            </div>
        </div>
    </div>
    <script>
       new Vue({
            el:'#app',
            data(){
                return{
                    user:{
                name1:"",
               
                writer1:"",
                date1:"",
                    }
          
                }
            },
        })
    </script>
    <form id="editTasksForm" method="GET"></form>
    <script src="ajaxTasks.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
    crossorigin="anonymous"></script>
</body>
</html>