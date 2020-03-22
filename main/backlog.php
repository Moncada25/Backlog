<?php 
$username = $_SESSION['SESION'][0]['username'];
$sql = "SELECT * FROM `task` WHERE `user_assigned` LIKE '$username' ";

if($db->db_sql($sql) != null){ ?>

    <div class="table-responsive">
        <table class="table table-striped table-light efecto-abajo text-xs-center">
        <thead>
        <th colspan="12">Backlog</th>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Assigned</th>
                <th scope="col">Task</th>
                <th scope="col">Description</th>
                <th scope="col">Points</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
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
            </tr>
        </tbody>

    <?php } ?>
    </table>

<?php
}else{ ?>

<div class="alert alert-success efecto-abajo" style="font-family: Times; font-size: 22px">
    Backlog empty...
</div>

<?php 
}
?>


