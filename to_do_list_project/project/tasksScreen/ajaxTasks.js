// A $(document).ready() block.
$( document ).ready(function() {
    $( "#addTasksForm" ).submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            type: "POST",
            url: "jsonFile/addTasks.php",
            data: $(this).serialize(),
            success: function(response)
           {
                console.log($(this));
                var jsonData = JSON.parse(response);
                console.log(response);
                if(jsonData.success =="1")
                {
                    let tr = `
                    <tr id = <?=$tasks["id"];?>>
                        <td> ${$("#addTasksForm #task_name").val()} </td>
                        <td> ${$("#addTasksForm #task_writer").val()} </td>
                        <td> ${$("#addTasksForm #final_date").val()} </td>
                        <td> <a class="deleteCustomer" href="#" data-id="x"> מחיקה </a> | <a class="#" href="#" data-id="x"> עריכה </a>
                        </tr>
                    `;
                    $("#tasksList").append(tr);
                }else{
                    alert("SOMETHING WENT WRONG");
                }
                window.close();
                window.open("try.php");
           } 
        });
    });

    $(document).on("click",".deleteTasks", function(e)
    {
        let parentTR = $(this).parents("tr");
        let id = this.id;
        e.preventDefault();
        $.ajax(
        {
           type: "POST",
           url: 'jsonFile/deleteTask.php',
           data:{"id":id},
           success: function(response)
           {
            console.log("eyal byle");
               var jsonData = JSON.parse(response);
               if(jsonData.success =="1")
               {
                   parentTR.fadeOut();
               }else{
                   alert("SOMETHING WENT WRONG");
               }
           } 
        });
    });

    $(document).on("click",".editTasks", function(e)
    {
        let parentTR = $(this).parents("tr");
        let name_task = parentTR.find("td.name_task").html();
        let writer = parentTR.find("td.writer").html();
        let date = parentTR.find("td.date").html();
        let id = this.id;
        let trHTML=`
        <td> <input type="text" name="name_task" id="name_task" value="${name_task}" form="editTasksForm"/> </td>
        <td> <input type="text" name="writer" id="writer" value="${writer}" form="editTasksForm"/> </td>
        <td> <input type="text" name="date" id="date" value="${date}" form="editTasksForm"/> 
        <input type="hidden" name="id" id=${id} value=${id} form="editTasksForm"/></td>
        <td> <input type="submit" value="שמור עריכה" form="editTasksForm"/> </td>
        `;
        parentTR.html(trHTML);

        $("#editTasksForm").submit(function(e)
        {
            e.preventDefault();
            $.ajax(
            {
            type: "POST",
            url: 'jsonFile/editTasks.php',
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response);
                if(jsonData.success =="1")
                {
                    alert("edit was successfull");
                }else{
                    alert("SOMETHING WENT WRONG");
                }
                window.close();
                window.open("try.php");
            } 
            });
        });
        
    });

});