<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>
<!-- ================ PHP SCRIPT ==================== -->
<?php
$departments = array("it","cs");
$error ="";
$succes = "";
// valditciones
if (isset($_POST["submit"])){
    $name       = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $department = filter_var($_POST['department'],FILTER_SANITIZE_STRING);
    $email      = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $password   = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

    if (empty($name) || empty($email) || empty($password) || empty($department)) {
        $error = "Please fill all the required fields";
    } elseif (strlen($name) < 7) {
        $error = "Name must be at least 7 characters long";
    }elseif (strlen($password) < 7) {
        $error = "Password must be at least 7 characters long";
    }elseif (!in_array(strtolower($department), $departments)) {
        $error = "The department must be CS or IT";
    }

    if (empty($error)){
        $db = new Database();
        $newpassword = $db->enc_password($password);
        $query= "INSERT INTO employees (`name`,`email`,`department`,`password`)
        values ('$name','$email','$department','$newpassword') ";
        $succes = $db->insert($query);
}





}






?>
<!-- ================ PHP SCRIPT ==================== -->
<div class="container">
        <div class="row ">
        <div class="col-md-10 ">
            <h2 class="p-3 mt-5 text-center text-white bg-dark rounded"> Add New Employee </h2>
        </div>
        <div class="col-md-2 align-content-center">
            <a href="employee.php" class="btn btn-dark bg-dark float-lift mt-5">
                <i class="fa-solid fa-users pe-2 text-warning"></i>All Employees</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?php if ($error != "") : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fa-solid fa-circle-exclamation pe-2"></i></strong> <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif;?>
            <?php if ($succes != "") : ?>
            <div class="alert alert-primary text-center alert-dismissible fade show" role="alert">
                <strong><i class="fa-solid fa-circle-exclamation pe-2"></i></strong> <?php echo $succes; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif;?>
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" name="department" class="form-control" id="department"
                        placeholder="Enter department">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>


                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Password">
                </div>
                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-dark mt-3 p-2 fs-5">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>