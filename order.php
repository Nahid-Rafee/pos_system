<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
    if($_SESSION['role']=="admin"){
        include_once'dashadmin.php';
    }else{
        include_once'dashop.php';
    }

?>


<html>
    <head>

<title>Dashboard</title>
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/fontawesome.min.css">
<link rel="stylesheet" href="css/all.min.css">


<style>
    .content-b{
        margin-left: 300px ;
        max-width: 1200px;
        width:1200px;
        display: inline-block;
    }

    .btn-success{
        margin-bottom: 15px;
        margin-top: 15px;
        color: black;
    }
   
</style>


</head>
    <body>
   
<nav class="nav-header">
<div class="nav-user-menu">



<div class="drop-down">
<?php echo '<i class="fas fa-circle"></i><span class="username">' .  $_SESSION['username'] . '</span>'; ?>
<button class="dropbtn" onclick="myFunction() ">  
<i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
  </button>
</div>
<div class="dropdown-content" id="myDropdown">
    <a href="logout.php">Log Out</a>
  </div>
</div>
</nav>

<div class="content-b">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Transaction
      </h1>
      <hr>
    </section>

    <!-- Main content -->
    <section class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Transaction List</h3>
                <a href="create_order.php" class="btn btn-success btn-sm ">Add Transaction</a>
            </div>
            <div class="box-body">
                <div style="overflow-x:auto;">
                    <table class="table table-striped" id="myOrder">
                        <thead>
                            <tr>
                                <th style="width:10px;">No</th>
                                <th style="width:50px;">Officer</th>
                                <th style="width:50px;">Date</th>
                                <th style="width:50px;">Total Bill</th>
                                <th style="width:50px;">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql=" SELECT * FROM invoice ORDER BY invoice_id DESC";
                            $result = mysqli_query($conn, $sql);


                            while($row = mysqli_fetch_assoc($result)){
                                $tol=json_decode(json_encode($row),FALSE);
                            ?>
                                <tr>
                                <td><?php echo $no++ ; ?></td>
                                <td class="text-uppercase"><?php echo $tol->cashier_name; ?></td>
                                <td><?php echo $tol->order_date; ?></td>
                                <td>BDT. <?php echo number_format($tol->total); ?></td>
                                <td>
                                    <?php if($_SESSION['role']=="admin"){ ?>
                                    <a href="delete_tran.php?id=<?php echo $tol->invoice_id; ?>" onclick="return confirm('Delete Transaction?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                    <a href="pdf.php?id=<?php echo $tol->invoice_id; ?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i></a>
                                </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->





  <script src="js/jquery.js" ></script>
  <script src="js/script.js" ></script>
  <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
  <script src="js/bootstrap.min.js" ></script> 
    </body>
</html>



