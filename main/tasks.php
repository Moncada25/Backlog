<?php

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $borrar = "DELETE FROM `task` WHERE `task`.`id` = $id";

    if($db->newRow($borrar) === 1){?>

        <div class="alert alert-success efecto-abajo" style="font-family: Times; font-size: 22px">
            Task deleted successfully
        </div>

    <?php
    }else{ ?>

        <div class="alert alert-danger efecto-abajo" style="font-family: Times; font-size: 22px">
            Error
        </div>       
    <?php 
    }
} else if(isset($_POST['btnEditTaskModal'])){
    
    $id = $_POST['idEdit'];

    $task = $_POST['taskName'];
    $points = $_POST['points'];
    $status = $_POST['selectStatus'];
    $description = $_POST['description'];

    $update = "UPDATE `task` SET `task` = '$task', `description` = '$description', `points` = '$points', `status` = '$status' WHERE `task`.`id` = '$id';";

    if($db->newRow($update) === 1){?>

        <div class="alert alert-success efecto-abajo" style="font-family: Times; font-size: 22px">
            Task updated successfully
        </div>

    <?php
    }else{ ?>

        <div class="alert alert-info efecto-abajo" style="font-family: Times; font-size: 22px">
            Nothing updated
        </div>       
    <?php 
    }
}
?>

<?php
$username = $_SESSION['SESION'][0]['username'];
$sql = "SELECT * FROM `task` WHERE `user_assigned` LIKE '$username' ";

if($db->db_sql($sql) != null){ ?>

    <div class="table-responsive">
    <table class="table table-striped table-light efecto-arriba text-xs-center">
    <thead>
    <th colspan="8">My tasks</th>
    <th colspan="4">
        <button id="btnAddTask" type="button" onclick="showAddTask()" class="btn-sm btn-success efecto-abajo">
            Add task
        </button>
    </th>
    
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Assigned</th>
        <th scope="col">Task</th>
        <th scope="col">Description</th>
        <th scope="col">Points</th>
        <th scope="col">Status</th>
        <th scope="col">Date</th>
        <th scope="col">Edit</th>                       
        <th scope="col">Delete</th>
    </tr>
    </thead>

    <?php 

    foreach ($db->db_sql($sql) as $task) { ?>

    <tbody>
    <tr>
        <td><?php echo $task['id']; ?></td>
        <td><?php echo $task['user_assigned']; ?></td>
        <td><?php echo $task['task']; ?></td>
        <td><?php echo $task['description']; ?></td>
        <td><?php echo $task['points']; ?></td>
        <td><?php echo $task['status']; ?></td>
        <td><?php echo $task['date']; ?></td>
        <td>
            <button id="btnEditTask" type="button" class="btn-sm btn-info" data-toggle="modal" data-target="#<?php echo "id" . $task['id']; ?>">
                Edit
            </button>

            <!-- Modal -->
            <div class="modal fade" id="<?php echo "id" . $task['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editTaskModal" aria-hidden="true">
                <div class="modal-dialog efecto-abajo" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="font-family:Times;">
                            <h4 class="modal-title" style="color:black;" id="editTaskModal">Assigned to <strong style="color:rgb(38, 146, 216);"><?php echo $task['user_assigned']; ?></strong></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="color:black;font-size:20px">
                            <form id="editTaskForm" action="" method="post">
                                <input type="hidden" value="<?php echo $task['id']; ?>" id="idEdit" name="idEdit"/>
                                <div style="margin-bottom: 25px; width: 40%;margin-left: auto;margin-right: auto;">
                                    <strong style="color:rgb(38, 146, 216);">Status</strong>
                                    <select id="selectStatus" name="selectStatus">
                                        <?php 
                                        switch($task['status']){

                                            case "New":
                                                echo("<option selected>New</option>
                                                <option>Active</option>
                                                <option>Impedimento</option>
                                                <option>Closed</option>
                                                <option>Removed</option>");
                                            break;
                                            case "Active":
                                            echo("<option>New</option>
                                                <option selected>Active</option>
                                                <option>Impedimento</option>
                                                <option>Closed</option>
                                                <option>Removed</option>");
                                            break;
                                            case "Impedimento":
                                            echo("<option>New</option>
                                                <option>Active</option>
                                                <option selected>Impedimento</option>
                                                <option>Closed</option>
                                                <option>Removed</option>");
                                            break;
                                            case "Closed":
                                            echo("<option>New</option>
                                                <option>Active</option>
                                                <option>Impedimento</option>
                                                <option selected>Closed</option>
                                                <option>Removed</option>");
                                            break;
                                            case "Removed":
                                            echo("<option>New</option>
                                                <option>Active</option>
                                                <option>Impedimento</option>
                                                <option>Closed</option>
                                                <option selected>Removed</option>");
                                            break;
                                            default:
                                            echo "Error...";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <strong style="color:rgb(38, 146, 216);">Task</strong>
                                <div style="margin-bottom: 25px;">
                                    <input type="text" style="color:black" value="<?php echo $task['task']; ?>" maxlength="30" name="taskName" id="taskName" required />
                                    <label alt="Label" data-placeholder="Task"></label>
                                </div>
                                <strong style="color:rgb(38, 146, 216);">Points</strong>
                                <div style="margin-bottom: 25px;">
                                    <input type="text" maxlength="2" value="<?php echo $task['points']; ?>" onkeypress="return numbersOnly(event)" name="points" id="points" required/>
                                    <label alt="Label" data-placeholder="Points"></label>
                                </div>
                                <strong style="color:rgb(38, 146, 216);">Description</strong>
                                <div>
                                    <textarea name="description" id="description" maxlength="1000" required><?php echo $task['description']; ?></textarea>
                                </div>
                            </div>
                            <button id="btnEditTaskModal" name="btnEditTaskModal" type="submit" class="btn-sm btn-info centrado">
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <button id="btnDeleteTask" type="button" class="btn-sm btn-danger" onclick="deleteAlert(<?php echo $task['id'] ?>)">
                Delete
            </button>
        </td>
    </tr>
    </tbody>

    <?php } ?>
    </table>
    </div>


<?php 
}else{ ?>

    <div class="alert alert-success efecto-abajo" style="font-family: Times; font-size: 22px">
        Backlog empty...
        <button id="btnAddTask" type="button" onclick="showAddTask()" class="btn-sm btn-success efecto-abajo">
            Add task
        </button>
    </div>

<?php 
}
?>

<hr class="efecto-abajo">

<div class="row">
        
    <div id="divAddTask" class="col-sm-10 float-left shadow-lg p-3 mb-5 efecto-derecha cajita" style="display:none;margin-bottom: 25px;">
    <form id="sendTaskForm" action="home.php" method="post">
    <h1>Add task</h1>
    <hr>
    <div class="row">
        <div class="form-row col-sm-4" style="margin-bottom: 25px;">
            <input type="text" style="color:black" maxlength="30" name="taskName" id="taskName" required />
            <label alt="Label" data-placeholder="Task"></label>
        </div>
        <div class="form-row col-sm-4" style="margin-bottom: 25px;">
            <select id="selectStatus" name="selectStatus">
                <option>New</option>
                <option>Active</option>
                <option>Impedimento</option>
                <option>Closed</option>
                <option>Removed</option>
            </select>
        </div>
        <div class="form-row col-sm-4" style="margin-bottom: 25px;">
            <input type="text" maxlength="2" onkeypress="return numbersOnly(event)" name="points" id="points" required/>
            <label alt="Label" data-placeholder="Points"></label>
        </div>
    </div>
    <h2>Description</h2>
    <div class="row">
        <div class="form-row col-sm-12" style="margin-bottom: 25px;">
            <textarea name="description" id="description" maxlength="500" required></textarea>
        </div>
    </div>
    </form>
    <button form="sendTaskForm" style="margin-bottom: 25px;" class="btn" name="btnSendTask" type="submit" id="btnSendTask">Add to backlog</button>
    </div>
</div>
