<?php
    require_once('../db.php');
    $id = $_POST["id"];
    $task_name = $_POST['name_task'];
    $task_writer = $_POST['writer'];
    $final_date = $_POST['date'];
    $sql = "UPDATE `tasks`
    SET `name_task` = '$task_name', `writer` = '$task_writer', `date` = '$final_date'
        WHERE id = $id";
    if($conn->query($sql) === TRUE)
    {
        echo json_encode(array('success' => 1));
    }else{
        echo json_encode(array('success' => 0));
    }
?>
