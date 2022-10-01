<?php
require_once './conn.php';
?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin page </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

    </style>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <h1>User Informations</h1>
    <div class="container">
        <table id="mytable" class="table table-bordred table-striped">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email </th>
                <th>Password </th>
                <th>role</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <?php
            $insert = $conn->prepare("SELECT * FROM users ");
            $insert->execute();
            $results = $insert->fetchAll(PDO::FETCH_OBJ);
            foreach ($results as $result) {
            ?>
                <tr>
                    <td><?php echo htmlentities($result->f_name); ?></td>
                    <td><?php echo htmlentities($result->l_name); ?></td>
                    <td><?php echo htmlentities($result->email); ?></td>
                    <td><?php echo htmlentities($result->password); ?></td>
                    <td><?php echo htmlentities($result->role); ?></td>
                    <td><a href="update.php?id=<?php echo htmlentities($result->id); ?>"><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil" style="font-size:16px;"></span></button></a></td>
                    <td><a href="userinfo.php?del=<?php echo htmlentities($result->id); ?>"><button class="btn btn-danger btn-xs " onClick="return confirm('Do you really want to delete');"><span class="glyphicon glyphicon-trash" style="font-size:16px;"></span></button></a></td>

                </tr>
            <?php } ?>
        </table>

    </div>
    <?php
    // Code for record deletion
if (isset($_REQUEST['del'])) {
    //Get row id
    $id = $_GET['del'];
    //Qyery for deletion
    $sql = "DELETE FROM users WHERE id='$id'";
    // Prepare query for execution
    $query = $conn->prepare($sql);
    // Query Execution
    $query->execute();
    // Mesage after updation
    echo "<script>alert('Record Updated successfully');</script>";
    // Code for redirection
    // echo "<script>window.location.href='http://localhost/formvvvvv/login.php'</script>";
}
    ?>
</body>

</html>