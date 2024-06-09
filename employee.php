<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>
<div class="container">
    <div class="row ">
        <div class="col-md-10 ">
            <h2 class="p-3 mt-5 text-center text-white bg-dark rounded"> All Employees </h2>
        </div>
        <div class="col-md-2 align-content-center">
            <a href="create-employee.php" class="btn btn-dark bg-dark float-lift mt-5">
                <i class="fas fa-plus-circle pe-2 text-warning"></i>Add Employee</a>
        </div>
    </div>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <?php $db = new Database;?>
            <tbody>
                <?php if (count($db->read('employees'))) : ?>
                    <?php $num = 0; ?>
                    <?php foreach ($db->read('employees') as $row) : ?>
                    <tr>
                    <td><?= ++$num ?></td>
                    <td><?php echo strtoupper($row['name']);  ?></td>
                    <td><?php echo $row['email'];  ?></td>
                    <td><?php echo strtoupper($row['department']);  ?></td>
                    <td>
                        <a href="edit-employee.php?id=<?php echo $row['id'] ?>" class="text-primary">
                            <i class="fa fa-pencil-square-o fa-2x"></i>
                        </a>
                    </td>

                    <td>
                        <a href="delete-employee.php?id=<?php echo $row['id'] ?>" class="text-danger">
                            <i class="fa fa-times fa-2x"></i>
                        </a>
                    </td>

                    <?php endforeach; ?>
                </tr>
            </tbody>
            <?php else: ?>
            <div class="col-sm-12">
                <h3 class="alert alert-danger mt-2 text-center"> Not Found Data </h3>
            </div>
            <?php  endif; ?>
        </table>
    </div>
</div>
</div>
<?php include "includes/footer.php"; ?>