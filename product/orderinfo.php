<?php
require_once '../conn.php';
// function updateStatus($status){
//     $sql = "UPDATE orders set status=:st where id='$id'";
//     $query = $conn->prepare($sql);
//     $query->bindParam(':st', $status, PDO::PARAM_STR);
//     $query->execute();
//     echo "<script>alert('Record Updated successfully');</script>";
//     echo "<script>window.location.href='orderinfo.php'</script>";
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Orders page </title>
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
    <h1>Order Informations</h1>
    <div class="container">
        <table id="mytable" class="table table-bordred table-striped">
            <thead>
                <th>user id</th>
                <th>product id</th>
                <th>bill id</th>
                <th>date_ordered</th>
                <th>total_price</th>
                <th>bill_number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email </th>
                <th>phone </th>
                <th>address </th>
                <th>status</th>
                <!-- <th>edit status</th> -->
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <?php
            $insert = $conn->prepare("SELECT * FROM orders 
            inner join bill  
            on orders.bill_id = bill.id");
            $insert->execute();
            $results = $insert->fetchAll(PDO::FETCH_OBJ);
            // print_r($results);
            // die;
            foreach ($results as $result) {
            ?>
            <tr>
                <td><?php echo htmlentities($result->user_id); ?></td>
                <td><?php echo htmlentities($result->product_id); ?></td>
                <td><?php echo htmlentities($result->bill_id); ?></td>
                <td><?php echo htmlentities($result->date_ordered); ?></td>
                <td><?php echo htmlentities($result->total_price); ?></td>
                <td><?php echo htmlentities($result->bill_number); ?></td>
                <td><?php echo htmlentities($result->f_name); ?></td>
                <td><?php echo htmlentities($result->l_name); ?></td>
                <td><?php echo htmlentities($result->email); ?></td>
                <td><?php echo htmlentities($result->phone); ?></td>
                <td><?php echo htmlentities($result->address); ?></td>
                <td><?php echo htmlentities($result->status); ?></td>
                <!-- <td>
                    <button>pending</button>
                    <button>completed</button>
                </td> -->
                <td><a href="updateo.php?id=<?php echo htmlentities($result->id); ?>"><button
                            class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"
                                style="font-size:16px;"></span></button></a>
                </td>
                <td><a href="orderinfo.php?del=<?php echo htmlentities($result->id); ?>"><button
                            class="btn btn-danger btn-xs "
                            onClick="return confirm('Do you really want to delete');"><span
                                class="glyphicon glyphicon-trash" style="font-size:16px;"></span></button></a>
                </td>

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
    $sql = "DELETE FROM orders WHERE id='$id'";
    // Prepare query for execution
    $query = $conn->prepare($sql);
    // Query Execution
    $query->execute();
    // Mesage after updation
    echo "<script>alert('Record Updated successfully');</scrip>";
    // Code for redirection
    // echo "<script>window.location.href='http://localhost/formvvvvv/login.php'</script>";
}
    ?>
</body>

</html>