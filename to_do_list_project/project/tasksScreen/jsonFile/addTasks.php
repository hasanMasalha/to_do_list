<?php session_start();?>
<?php
    require_once("../db.php");
    $task_name = $_POST['task_name'];
    $task_writer = $_POST['task_writer'];
    $final_date = $_POST['final_date'];
    
    $sql = "INSERT INTO `tasks`(`email`, `name_task`, `writer`, `date`, `group`)
    VALUES('".$_SESSION['user_email']."', '$task_name', '$task_writer', '$final_date', '".$_SESSION['group_id']."')";
    if($conn->query($sql) === TRUE)
    {
        $last_id = $conn->insert_id;
        echo json_encode(array('success' => 1, "id"=>$last_id));
    }else{
        echo json_encode(array('success' => 0));
    }
    $conn->close();
?>

